<?php

require_once __DIR__. '/../db.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD'] !== 'PUT')
{

    http_response_code(400);
    echo json_encode(['message' => 'Method Harus Put']);
    exit();

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


$data = json_decode(file_get_contents('php://input'),true);

if(!isset($data['name']) || !isset($data['email']) || !isset($data['id']))
{

    http_response_code(400);
    echo json_encode(['message' => 'data tidak ada']);
    exit();

}else
{

    $id = $data['id'];
    $name = $data['name'];
    $email = $data['email'];

}

$sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);

if ($stmt->execute([$name, $email, $id])) {

    echo json_encode(['message' => 'Berhasil updated']);
    exit();

} else {

    http_response_code(500);
    echo json_encode(['message' => 'Failed to update user']);
    exit();

}

?>