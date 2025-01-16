<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ClientModel;
use App\Services\GeolocationService;
use App\Services\ClientValidationService;

class Clients extends Controller {

    protected $clientModel;
    protected $geolocationService;
    protected $clientValidationService;

    public function __construct()
    {
        $this->clientModel = new ClientModel();
        $this->geolocationService = new GeolocationService();
        $this->clientValidationService = new ClientValidationService();
    }

    public function index()
    {
        $clients = $this->clientModel->findAll();
        return view('clients/list', ['clients' => $clients]);
    }

    public function create()
    {
        return view('clients/create');
    }

    public function store()
    {
        $validation = $this->clientValidationService->validate($this->request);

        if (!$validation['valid']) {
            return redirect()->back()->withInput()->with('errors', $validation['errors']);
        }

        $data = [
            'nome' => $this->request->getPost('nome'),
            'email' => $this->request->getPost('email'),
            'telefone' => $this->request->getPost('telefone'),
            'segmento' => $this->request->getPost('segmento'),
            'cep' => str_replace('-', '', $this->request->getPost('cep')),
            'latitude' => (float) $this->request->getPost('latitude'),
            'longitude' => (float) $this->request->getPost('longitude'),
        ];

        $this->clientModel->insert($data);

        return redirect()->to('/clients')->with('success', 'Cliente criado com sucesso!');
    }

    public function edit($id)
    {
        $client = $this->clientModel->find($id);
        $client['cep'] = str_replace('-', '', $client['cep']);

        return view('clients/edit', ['client' => $client]);
    }

    public function update($id)
    {
        $validation = $this->clientValidationService->validate($this->request);

        if (!$validation['valid']) {
            return redirect()->back()->withInput()->with('errors', $validation['errors']);
        }

        $data = [
            'nome' => $this->request->getPost('nome'),
            'email' => $this->request->getPost('email'),
            'telefone' => $this->request->getPost('telefone'),
            'segmento' => $this->request->getPost('segmento'),
            'cep' => str_replace('-', '', $this->request->getPost('cep')),
            'latitude' => (float) $this->request->getPost('latitude'),
            'longitude' => (float) $this->request->getPost('longitude'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->clientModel->update($id, $data);

        return redirect()->to('/clients')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function delete($id)
    {
        $this->clientModel->delete($id);
        return redirect()->to('/clients')->with('success', 'Cliente excluído com sucesso!');
    }

    public function restore($id)
    {
        $this->clientModel->restore($id);
        return redirect()->to('/clients')->with('success', 'Cliente restaurado com sucesso!');
    }
}
