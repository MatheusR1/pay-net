<?php

namespace App\Service;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ViaCepService implements ViaCepImpl
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getAdressInfo(string $cep): array
    {
        try {
            $response = $this->client->get("https://viacep.com.br/ws/{$cep}/json/");
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return ['error' => 'nao foi possivel conectar a via cep'];
        }
    }
}
