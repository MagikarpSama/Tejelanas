<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

header('Content-Type: application/json');

$headers = getallheaders();
if (
    !isset($headers['Authorization']) ||
    $headers['Authorization'] !== 'Bearer ipss.get'
) {
    http_response_code(401);
    echo json_encode(["mensaje" => "No autorizado"]);
    exit;
}

require_once __DIR__ . '/routes/routes.php';

http_response_code(404);
echo json_encode(["mensaje" => "Endpoint no encontrado"]);