<?php
require_once __DIR__ . '/../models/Servicio.php';

class ServicioController {
    public static function index() {
        echo json_encode(['data' => ['productos' => Servicio::getAll()]]);
    }

    public static function show($id) {
        $servicio = Servicio::getById($id);
        if ($servicio) {
            echo json_encode(['data' => $servicio]);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "Servicio no encontrado."]);
        }
    }

    public static function create() {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || !isset($data['nombre']) || !isset($data['descripcion'])) {
            http_response_code(400);
            echo json_encode(["mensaje" => "Datos incompletos"]);
            return;
        }
        $nuevo = Servicio::create($data);
        http_response_code(201);
        echo json_encode(['data' => $nuevo]);
    }

    public static function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            http_response_code(400);
            echo json_encode(["mensaje" => "Datos incompletos"]);
            return;
        }
        $actualizado = Servicio::update($id, $data);
        if ($actualizado) {
            echo json_encode(['data' => $actualizado]);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "Servicio no encontrado."]);
        }
    }

    public static function delete($id) {
        $eliminado = Servicio::delete($id);
        if ($eliminado) {
            echo json_encode(["mensaje" => "Servicio eliminado"]);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "Servicio no encontrado."]);
        }
    }
}