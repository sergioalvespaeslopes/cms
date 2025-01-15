<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ClientModel;

class Dashboard extends Controller
{
    public function index()
    {
        $model = new ClientModel();

        // Coordenadas da Cheil Brasil
        $cheil_lat = -23.561684;
        $cheil_long = -46.625378;

        // Consultando clientes e suas coordenadas
        $clients = $model->select('nome, latitude, longitude, COUNT(*) as total')
                         ->groupBy('nome')
                         ->findAll();

        $segments = [];
        $counts = [];
        $distances = [];

        // Função para calcular a distância usando a fórmula de Haversine
        function haversine($lat1, $lon1, $lat2, $lon2)
        {
            $R = 6371; // Raio da Terra em km
            $phi1 = deg2rad($lat1);
            $phi2 = deg2rad($lat2);
            $delta_phi = deg2rad($lat2 - $lat1);
            $delta_lambda = deg2rad($lon2 - $lon1);

            $a = sin($delta_phi / 2) * sin($delta_phi / 2) +
                cos($phi1) * cos($phi2) *
                sin($delta_lambda / 2) * sin($delta_lambda / 2);

            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

            return $R * $c; // Retorna a distância em km
        }

        foreach ($clients as $client) {
            $segments[] = $client['nome'];

            // Converte latitude e longitude para float
            $latitude = (float)$client['latitude'];
            $longitude = (float)$client['longitude'];

            // Verifica coordenadas inválidas
            if ($latitude < -90 || $latitude > 90 || $longitude < -180 || $longitude > 180) {
                error_log("Coordenadas inválidas para {$client['nome']}: Latitude $latitude, Longitude $longitude");
                continue;
            }

            // Calcula a distância para a Cheil Brasil
            $distance = haversine($cheil_lat, $cheil_long, $latitude, $longitude);
            $distances[] = round($distance, 2);

            $counts[] = $client['total'];
        }

        // Debug das saídas
        error_log("Segments: " . json_encode($segments));
        error_log("Counts: " . json_encode($counts));
        error_log("Distances: " . json_encode($distances));

        return view('dashboard/index', [
            'segments' => $segments,
            'counts' => $counts,
            'distances' => $distances,
        ]);
    }
}
