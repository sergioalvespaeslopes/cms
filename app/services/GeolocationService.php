<?php
namespace App\Services;

class GeolocationService {

    public function getGeolocationByCep($cep)
    {
        $url = "https://viacep.com.br/ws/{$cep}/json/";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        return [
            'latitude' => $data['latitude'] ?? null,
            'longitude' => $data['longitude'] ?? null
        ];
    }
}
