<?php

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;


$client = new GuzzleHttp\Client(['base_uri' => 'http://localhost/guzzle/']);
$headers = ['headers' => ['api-key' => 'key-thoriq']];
$response = $client->request('GET', 'latihan/get.php?id=2', $headers);

// Ambil body dari respons
$responseBody = $response->getBody();
echo $response->getStatusCode();
echo $response->getReasonPhrase();

// Ubah body respons menjadi string
$responseBodyString = (string) $responseBody;

// Konversi JSON menjadi array PHP
$dataArray = json_decode($responseBodyString, true);

print_r($dataArray);
