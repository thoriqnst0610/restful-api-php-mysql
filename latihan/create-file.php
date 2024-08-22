<?php

require_once __DIR__ . '/../db.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Acces-COntrol-Allow-Origin: *');

//cek apakah request method adalah POST
if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    http_response_code(405);
    echo json_encode(['message' => 'Method harus Post']);
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

// cek apakah ada variabel global files
if (!isset($_FILES['file'])) {

    http_response_code(400);
    echo json_encode(['message' => 'file tidak ada']);
    exit();

} else {

    $file = $_FILES['file'];
    uploadFile($file);
}

// Fungsi untuk menangani upload file
function uploadFile($file)
{
    //folder untuk upload gmabar
    $targetDir = "upload/";

    //buat uniq nama file + nama_asli file
    $uniqueFileName = uniqid() . '-' . basename($file["name"]);
    $targetFile = $targetDir . $uniqueFileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Cek apakah file gambar adalah gambar sebenarnya
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {

        //echo "File adalah gambar - " . $check["mime"] . ".";

    } else {

        http_response_code(400);
        echo json_encode(['message' => 'file yang di upload bukan gambar']);
        $uploadOk = 0;
        exit();
        
    }

    // Cek format file
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif") {

        http_response_code(400);
        echo json_encode(['message' => 'format gambar salah']);
        $uploadOk = 0;
        exit();
    }

    // Cek ukuran file
    if ($file["size"] > 1000000) { // 1 MB = 1,000,000 bytes

        http_response_code(400);
        echo json_encode(['message' => 'ukuran maksimal 1 mb']);
        $uploadOk = 0;
        exit();
    }

    // Cek apakah $uploadOk diset ke 0 oleh kesalahan
    if ($uploadOk == 0) {

        http_response_code(400);
        echo json_encode(['message' => 'file tidak di upload']);
        $uploadOk = 0;
        exit();

    } else {

        

        if (move_uploaded_file($file["tmp_name"], $targetFile)) {

            gembarkedatabase($uniqueFileName);

        } else {

            http_response_code(400);
            echo json_encode(['message' => 'terjadi kesalahan saat mengupload file']);
            $uploadOk = 0;
            exit();

        }

    }
}

//fungsi mengupload gambar ke database
function gembarkedatabase(string $nama)
{

    global $pdo;

    $sql = "INSERT INTO gambar (nama) VALUES (?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$nama])) {

        http_response_code(201);
        echo json_encode(['id' => $pdo->lastInsertId()]);
    } else {

        http_response_code(500);
        echo json_encode(['message' => 'gagal menambah data']);
    }
}
