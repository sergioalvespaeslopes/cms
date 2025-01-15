<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ClientModel;
use App\Services\CepService;

class Clients extends Controller {

    public function __construct()
    {
        $this->clientModel = new ClientModel();
        $this->cepService = new CepService(); // Instanciando o serviço de CEP
    }

    public function index() {
        $clients = $this->clientModel->findAll();
        return view('clients/list', ['clients' => $clients]);
    }

    public function create() {
        return view('clients/create');
    }

    // Método para armazenar cliente
    public function store() {
        // Validação dos campos
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nome' => 'required',
            'email' => 'required|valid_email',
            'telefone' => 'required',
            'segmento' => 'required',
            'cep' => 'required',
            'latitude' => 'required|decimal',
            'longitude' => 'required|decimal'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Se a validação falhar, retorna com erros
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Captura os dados do formulário
        $data = [
            'nome' => $this->request->getPost('nome'),
            'email' => $this->request->getPost('email'),
            'telefone' => $this->request->getPost('telefone'),
            'segmento' => $this->request->getPost('segmento'),
            'cep' => str_replace('-', '', $this->request->getPost('cep')), // Remover hífen do CEP
            'latitude' => (float) $this->request->getPost('latitude'), // Garantir que a latitude seja um float
            'longitude' => (float) $this->request->getPost('longitude'), // Garantir que a longitude seja um float
        ];

        // Carregar o modelo e salvar no banco
        $this->clientModel->insert($data);

        // Redirecionar ou mostrar sucesso
        return redirect()->to('/clients')->with('success', 'Cliente criado com sucesso!');
    }

    // Método para editar cliente
    public function edit($id) {
        $client = $this->clientModel->find($id);
        
        // Remover o hífen do 'cep' no cliente editado, se necessário
        $client['cep'] = str_replace('-', '', $client['cep']);

        return view('clients/edit', ['client' => $client]);
    }

    // Método para atualizar cliente
    public function update($id)
    {
        // Recebe o CEP do formulário
        $cep = str_replace('-', '', $this->request->getPost('cep')); // Remover hífen do CEP

        // Consultar a API do ViaCEP para obter a latitude e longitude
        $geolocation = $this->cepService->getGeolocationByCep($cep);

        // Se a geolocalização for encontrada, preenche latitude e longitude
        $latitude = $geolocation['latitude'] ?? null;
        $longitude = $geolocation['longitude'] ?? null;

        // Garantir que latitude e longitude tenham a precisão correta
        if ($latitude !== null) {
            $latitude = (float) $latitude; // Garantir que seja um número float
        }

        if ($longitude !== null) {
            $longitude = (float) $longitude; // Garantir que seja um número float
        }

        $data = [
            'nome' => $this->request->getPost('nome'),
            'email' => $this->request->getPost('email'),
            'telefone' => $this->request->getPost('telefone'),
            'segmento' => $this->request->getPost('segmento'),
            'cep' => $cep,  // Atualizando o campo 'cep' sem hífen
            'latitude' => $latitude,
            'longitude' => $longitude,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->clientModel->update($id, $data);
        return redirect()->to('/clients');
    }

    // Método para deletar cliente
    public function delete($id) {
        $this->clientModel->delete($id);
        return redirect()->to('/clients');
    }
}
