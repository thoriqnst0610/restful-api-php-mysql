<?php

require_once __DIR__. '/../vendor/autoload.php'; // Pastikan Anda memuat autoload Composer

use GuzzleHttp\Client;

// URL endpoint API
$url = 'http://localhost/guzzle/latihan/create-file.php'; // Gantilah URL ini sesuai dengan server Anda

// Path ke file yang akan diupload
$filePath = 'tetap.PNG'; // Gantilah dengan path file yang akan diupload

// API Key yang digunakan
$apiKey = 'key-thoriq'; // Gantilah dengan API Key yang sesuai

// Membuat instance Guzzle HTTP Client
$client = new Client();

try {
    $response = $client->request('POST', $url, [
        'headers' => [
            'api-key' => $apiKey
        ],
        'multipart' => [
            [
                'name'     => 'file',
                'contents' => fopen($filePath, 'r'),
                'filename' => basename($filePath)
            ]
        ]
    ]);

    // Menampilkan respons dari server
    echo $response->getBody();
} catch (\GuzzleHttp\Exception\RequestException $e) {
    // Menampilkan pesan kesalahan jika ada
    echo 'Request failed: ' . $e->getMessage();
}
