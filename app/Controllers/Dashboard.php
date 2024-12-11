<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ClientModel;

class Dashboard extends Controller
{
    public function index()
    {
        $model = new ClientModel();

        $clients = $model->select('segmento, COUNT(*) as total')
            ->groupBy('segmento')
            ->findAll();

        $segments = [];
        $counts = [];

        foreach ($clients as $client) {
            $segments[] = $client['segmento'];
            $counts[] = $client['total']; 
        }

        return view('dashboard/index', ['segments' => $segments, 'counts' => $counts]);
    }
}
