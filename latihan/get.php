<?php

require_once __DIR__ . '/../db.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-COntrol-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['message' => 'Method Harus Get']);
    exit;
}

function isApiKeyValid($apiKey, $pdo) 
{

    $sql = "SELECT COUNT(*) FROM api_key WHERE `key` = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$apiKey]);
    return $stmt->fetchColumn() > 0;

}

$headers = apache_request_headers();

if(!isset($headers['api-key']) || !isApiKeyValid($headers['api-key'], $pdo))
{

    http_response_code(403);
    echo json_encode(['message' => 'api-key tidak valid']);
    exit();

}

$data = json_decode(file_get_contents('php://input'), true);

if(!isset($data['id']))
{

    http_response_code(400);
    echo json_encode(['message' => 'id tidak ada']);
    exit();

}else
{

    $id = $data['id'];

}

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$user = $stmt->fetch();

if ($user) {
    echo json_encode($user);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'User not found']);
}
?>
