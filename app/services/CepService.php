<?php

namespace App\Services;

class CepService
{
    public function getGeolocationByCep($cep)
    {
        // Remover hífen do CEP
        $cep = str_replace('-', '', $cep);

        // Consultando a API do ViaCEP
        $url = "https://viacep.com.br/ws/{$cep}/json/";
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        // Verificando se a consulta foi bem-sucedida
        if (isset($data['erro']) && $data['erro'] === true) {
            return null; // Caso o CEP seja inválido
        }

        // Retorna a latitude e longitude do CEP
        return [
            'latitude' => $data['latitude'] ?? null, // Se disponível na API
            'longitude' => $data['longitude'] ?? null // Se disponível na API
        ];
    }
}
