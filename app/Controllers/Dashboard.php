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

        $cheil_lat = -23.620007575935897;
        $cheil_long = -46.701493424123456;

        $clients = $model->select('nome, latitude, longitude')
                         ->findAll();

        $segments = [];
        $counts = [];
        $distances = [];

        function haversine($lat1, $lon1, $lat2, $lon2)
        {
            $R = 6371; 
            $phi1 = deg2rad($lat1);
            $phi2 = deg2rad($lat2);
            $delta_phi = deg2rad($lat2 - $lat1);
            $delta_lambda = deg2rad($lon2 - $lon1);

            $a = sin($delta_phi / 2) * sin($delta_phi / 2) +
                cos($phi1) * cos($phi2) *
                sin($delta_lambda / 2) * sin($delta_lambda / 2);

            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

            return $R * $c;
        }

        foreach ($clients as $client) {
            $latitude = (float) $client['latitude'];
            $longitude = (float) $client['longitude'];

            $segments[] = $client['nome'];

            $distance = haversine($cheil_lat, $cheil_long, $latitude, $longitude);
            $distances[] = $distance;

            $adjustedCount = 1 * (1 + $distance / 100); 
            $counts[] = round($adjustedCount, 2);
        }

        return view('dashboard/index', [
            'segments' => $segments,
            'counts' => $counts,
            'distances' => $distances 
        ]);
    }
}
