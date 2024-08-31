<?php

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client(['base_uri' => 'http://localhost/guzzle/']);

$headers = [
    'api-key' => 'key-thoriq',
    'Content-Type' => 'application/json'
];

$data = [
    'name' => 'John Thoriq',
    'email' => 'john.thoriq.com',
    'id' => 10
];

// Mengirim data JSON
$response = $client->request('PUT', 'latihan/update.php', [
    'headers' => $headers,
    'json' => $data
]);

// Mengambil body dari respons
$responseBody = $response->getBody();
$responseBodyString = (string) $responseBody;

// Konversi JSON menjadi array PHP
$dataArray = json_decode($responseBodyString, true);

if (json_last_error() === JSON_ERROR_NONE) {
    // Berhasil mengkonversi JSON, tampilkan array
    print_r($dataArray);
} else {
    // Terjadi kesalahan dalam parsing JSON
    echo 'Error decoding JSON: ' . json_last_error_msg();
}

// Tampilkan status dan alasan
echo $response->getStatusCode();
echo $response->getReasonPhrase();
