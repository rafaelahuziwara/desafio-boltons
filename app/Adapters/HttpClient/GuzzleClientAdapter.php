<?php

namespace App\Adapters\HttpClient;

use App\Adapters\Modules\NFe\NFeDTO;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use Core\Modules\NFe\PushNFes\Gateways;

class GuzzleClientAdapter implements Gateways\PushNFeGateway
{
    public function __construct()
    {
    }

    public function pushNFe(): array
    {
        $client = $this->createConnection();
        $nfeDTO = new NFeDTO();
        try {
            $response = $client->request('GET', '/v1/nfe/received');
            return $nfeDTO->fromJson($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            dump($e);
            return [];
        }
    }

    private function createConnection(): Client
    {
        return new Client([
            'base_uri' => config('services.sandbox.base_uri'),
            'headers' => [
                'x-api-key' => config('services.sandbox.x-api-key'),
                'x-api-id' => config('services.sandbox.x-api-id'),
                'Content-Type' => 'application/json',
            ],
            'query' => [
                'limit' => '3'
            ]
        ]);
    }
}
