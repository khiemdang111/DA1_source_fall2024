<?php
namespace App\Models;

use GuzzleHttp\Client;

class GHTKModel
{
    private $client;
    private $token;
    private $apiUrl;

    public function __construct()
    {
        $this->token = $_ENV['GHTK_API_TOKEN'];
        $this->apiUrl = $_ENV['GHTK_API_URL'];
        $this->client = new Client([
            'base_uri' => $this->apiUrl,
            'headers' => [
                'Token' => $this->token,
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    public function createOrder($data)
    {
        try {
            $response = $this->client->post('/services/shipment/order', [
                'json' => $data
            ]);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getOrderStatus($orderId)
    {
        try {
            $response = $this->client->get("/services/shipment/v2/{$orderId}");
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
