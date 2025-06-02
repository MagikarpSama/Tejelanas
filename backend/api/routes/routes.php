<?php
require_once __DIR__ . '/../controllers/ServicioController.php';
require_once __DIR__ . '/../controllers/AboutUsController.php';
require_once __DIR__ . '/../controllers/FaqController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/tejelanas/backend/api', '', $uri);
$method = $_SERVER['REQUEST_METHOD'];

if (preg_match('#^/v1/products-services/?(\d+)?$#', $uri, $matches)) {
    if ($method === 'GET') {
        if (!empty($matches[1])) {
            ServicioController::show($matches[1]);
        } else {
            ServicioController::index();
        }
    } elseif ($method === 'POST' && empty($matches[1])) {
        ServicioController::create();
    } elseif ($method === 'PUT' && !empty($matches[1])) {
        ServicioController::update($matches[1]);
    } elseif ($method === 'DELETE' && !empty($matches[1])) {
        ServicioController::delete($matches[1]);
    } else {
        http_response_code(405);
        echo json_encode(["mensaje" => "Método no permitido"]);
    }
    exit;
}
if ($uri === '/v1/about-us' && $method === 'GET') {
    AboutUsController::index();
    exit;
}
if ($uri === '/v1/faq' && $method === 'GET') {
    FaqController::index();
    exit;
}