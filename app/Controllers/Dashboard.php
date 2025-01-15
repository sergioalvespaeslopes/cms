<?php
namespace App\Controllers;
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ClientModel;

class Dashboard extends Controller
{
    public function index()
    {
        $model = new ClientModel();

        // Coordenadas da Cheil Brasil
        $cheil_lat = -23.620007575935897;
        $cheil_long = -46.701493424123456;

        // Consultando clientes e suas coordenadas, sem agrupar pelo nome
        $clients = $model->select('nome, latitude, longitude')
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

        // Preenche os arrays com dados
        foreach ($clients as $client) {
            // Converte latitude e longitude para float caso sejam strings
            $latitude = (float) $client['latitude'];
            $longitude = (float) $client['longitude'];

            $segments[] = $client['nome'];

            // Calcula a distância de cada cliente para a Cheil Brasil
            $distance = haversine($cheil_lat, $cheil_long, $latitude, $longitude);
            $distances[] = $distance;

            // Ajusta a contagem com base na distância
            $adjustedCount = 1 * (1 + $distance / 100); // Ajusta como quiser
            $counts[] = round($adjustedCount, 2); // Arredondando para 2 casas decimais
        }

        // Passa os dados para a view
        return view('dashboard/index', [
            'segments' => $segments,
            'counts' => $counts,
            'distances' => $distances // Passando as distâncias calculadas
        ]);
    }
}
