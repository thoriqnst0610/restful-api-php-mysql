<?php

require_once __DIR__. '/../db.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Acces-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['message' => 'Method Harus Get']);
    exit;
}

if(!isset($_COOKIE['user'])){

    http_response_code(405);
    echo json_encode(['message' => 'Cookie tidak di set']);
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

$sql = "SELECT * FROM users";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($user) {

    http_response_code(200);
    echo json_encode($user);

} else {

    http_response_code(404);
    echo json_encode(['message' => 'User not found']);

}
?>