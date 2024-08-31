<?php

require_once __DIR__ . '/../db.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['message' => 'Method Not Allowed']);
    exit;
}

// Fungsi untuk memeriksa keabsahan API key
function isApiKeyValid($apiKey, $pdo) 
{
    $sql = "SELECT COUNT(*) FROM api_key WHERE `key` = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$apiKey]);
    return $stmt->fetchColumn() > 0;
}

// Mengambil header permintaan dengan cara yang benar
$headers = getallheaders(); // Menggunakan getallheaders() untuk mendapatkan header

// Memeriksa apakah header 'api-key' ada dan valid
if (!isset($headers['api-key']) || !isApiKeyValid($headers['api-key'], $pdo)) {
    http_response_code(403);
    echo json_encode(['message' => 'api-key tidak valid']);
    exit();
}

// Mengambil data JSON dari permintaan
$data = json_decode(file_get_contents('php://input'), true);

// Memeriksa apakah data yang diperlukan ada
if (!isset($data['name']) || !isset($data['email'])) {
    http_response_code(400);
    echo json_encode(['message' => 'invalid input']);
    exit();
} else {
    $name = $data['name'];
    $email = $data['email'];
}

// Memasukkan data ke database
$sql = "INSERT INTO users (name, email) VALUES (?, ?)";
$stmt = $pdo->prepare($sql);

if ($stmt->execute([$name, $email])) {
    http_response_code(201);
    echo json_encode(['id' => $pdo->lastInsertId()]);
} else {
    http_response_code(500);
    echo json_encode(['message' => 'gagal menambah data']);
}
