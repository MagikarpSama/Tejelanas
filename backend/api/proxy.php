<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$endpoints = [
    'products-services' => 'https://www.clinicatecnologica.cl/ipss/tejelanasVivi/api/v1/products-services',
    'about-us'          => 'https://www.clinicatecnologica.cl/ipss/tejelanasVivi/api/v1/about-us',
    'faq'               => 'https://www.clinicatecnologica.cl/ipss/tejelanasVivi/api/v1/faq'
];

$endpoint = $_GET['endpoint'] ?? '';

if (!isset($endpoints[$endpoint])) {
    http_response_code(400);
    echo json_encode(['error' => 'Endpoint no permitido']);
    exit;
}

$url = $endpoints[$endpoint];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer ipss.get",
    "Accept: application/json"
]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);

if ($response === false) {
    http_response_code(500);
    echo json_encode(['error' => 'cURL error: ' . curl_error($ch)]);
    curl_close($ch);
    exit;
}

$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
curl_close($ch);

header('Content-Type: application/json');
http_response_code($httpcode);

if (strpos($contentType, 'application/json') === false) {
    echo json_encode(['error' => 'Respuesta no es JSON', 'content' => $response]);
    exit;
}

echo $response;