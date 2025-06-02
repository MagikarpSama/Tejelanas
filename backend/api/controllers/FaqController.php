<?php
require_once __DIR__ . '/../models/Faq.php';

class FaqController {
    public static function index() {
        header('Content-Type: application/json');
        
        try {
            $faq = new Faq();
            
            $data = $faq->obtenerTodos();
            
            echo json_encode(['data' => $data]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al obtener las preguntas frecuentes', 'mensaje' => $e->getMessage()]);
        }
    }
}