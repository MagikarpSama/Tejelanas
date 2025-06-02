<?php
require_once(__DIR__ . '/php-client/vendor/autoload.php');

use Swagger\Client\Api\DefaultApi;
use Swagger\Client\Configuration;
use Swagger\Client\ApiException;

// Configurar cliente
$config = Configuration::getDefaultConfiguration()
    ->setHost('http://localhost/tejelanas/backend/api')
    ->setAccessToken('ipss.get'); // Tu token Bearer

$apiInstance = new DefaultApi(
    new GuzzleHttp\Client(),
    $config
);

// Array para almacenar resultados de pruebas
$testResults = [];

// Función para probar endpoints y registrar resultados
function testEndpoint($name, $callback) {
    global $testResults;
    try {
        $result = $callback();
        $testResults[$name] = [
            'status' => 'SUCCESS',
            'message' => 'Test completado correctamente',
            'data' => $result
        ];
    } catch (ApiException $e) {
        $testResults[$name] = [
            'status' => 'ERROR',
            'message' => $e->getMessage(),
            'code' => $e->getCode()
        ];
    } catch (Exception $e) {
        $testResults[$name] = [
            'status' => 'ERROR',
            'message' => $e->getMessage()
        ];
    }
}

// Prueba 1: Obtener todos los servicios
testEndpoint('GET /v1/products-services', function() use ($apiInstance) {
    return $apiInstance->v1ProductsServicesGet();
});

// Prueba 2: Obtener un servicio específico
testEndpoint('GET /v1/products-services/1', function() use ($apiInstance) {
    return $apiInstance->v1ProductsServicesIdGet(1);
});

// Prueba 3: Crear un nuevo servicio
testEndpoint('POST /v1/products-services', function() use ($apiInstance) {
    $servicio = new \Swagger\Client\Model\Servicio([
        'nombre' => 'Servicio de Prueba',
        'descripcion' => 'Este es un servicio creado por la prueba automatizada'
    ]);
    return $apiInstance->v1ProductsServicesPost($servicio);
});

// Prueba 4: Actualizar un servicio
testEndpoint('PUT /v1/products-services/1', function() use ($apiInstance) {
    $servicio = new \Swagger\Client\Model\Servicio([
        'nombre' => 'Servicio Actualizado',
        'descripcion' => 'Este servicio fue actualizado por la prueba automatizada'
    ]);
    return $apiInstance->v1ProductsServicesIdPut(1, $servicio);
});

// Prueba 5: Obtener información "Acerca de"
testEndpoint('GET /v1/about-us', function() use ($apiInstance) {
    return $apiInstance->v1AboutUsGet();
});

// Prueba 6: Obtener FAQs
testEndpoint('GET /v1/faq', function() use ($apiInstance) {
    return $apiInstance->v1FaqGet();
});

// Mostrar resultados
echo "=== RESULTADOS DE PRUEBAS AUTOMATIZADAS ===\n\n";
foreach ($testResults as $name => $result) {
    echo "PRUEBA: $name\n";
    echo "ESTADO: " . $result['status'] . "\n";
    echo "MENSAJE: " . $result['message'] . "\n";
    if (isset($result['data'])) {
        echo "DATOS: " . json_encode($result['data'], JSON_PRETTY_PRINT) . "\n";
    }
    echo "\n----------------------------\n\n";
}