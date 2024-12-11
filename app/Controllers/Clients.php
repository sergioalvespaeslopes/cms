<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ClientModel;

class Clients extends Controller {

    public function __construct() {
        $this->clientModel = new ClientModel();
    }

    public function index() {
        $clients = $this->clientModel->findAll();
        return view('clients/list', ['clients' => $clients]);
    }

    public function create() {
        return view('clients/create');
    }

    public function store() {
        $data = [
            'nome' => $this->request->getPost('nome'),
            'email' => $this->request->getPost('email'),
            'telefone' => $this->request->getPost('telefone'),
            'segmento' => $this->request->getPost('segmento'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->clientModel->save($data);
        return redirect()->to('/clients');
    }

    public function edit($id) {
        $client = $this->clientModel->find($id);
        return view('clients/edit', ['client' => $client]);
    }

    public function update($id) {
        $data = [
            'nome' => $this->request->getPost('nome'),
            'email' => $this->request->getPost('email'),
            'telefone' => $this->request->getPost('telefone'),
            'segmento' => $this->request->getPost('segmento'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->clientModel->update($id, $data);
        return redirect()->to('/clients');
    }

    public function delete($id) {
        $this->clientModel->delete($id);
        return redirect()->to('/clients');
    }
}
