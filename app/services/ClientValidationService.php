<?php 
// Application/Services/ClientValidationService.php
namespace App\Services;

use CodeIgniter\Validation\ValidationInterface;

class ClientValidationService {

    public function validate($request)
    {
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

        $isValid = $validation->withRequest($request)->run();

        return [
            'valid' => $isValid,
            'errors' => $validation->getErrors()
        ];
    }
}
