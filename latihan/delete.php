<?php

require_once __DIR__. '/../db.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Acces-COntrol-Allow-Origin: *');

$data = json_decode(file_get_contents('php://input'),true);

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {

    http_response_code(405);
    echo json_encode(['message' => 'Method harus DELETE']);
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

if(!isset($data['id']))
{

    http_response_code(400);
    echo json_encode(['message' => 'tidak ada id']);
    exit();

}else
{

    $id = $data['id'];

}

$sql = "DELETE FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);

if ($stmt->execute([$id]))
{
    
    http_response_code(201);
    echo json_encode(['message' => 'Berhasil Menghapus']);

} else {

    http_response_code(500);
    echo json_encode(['message' => 'Gagal Menghapus']);

}

?>
