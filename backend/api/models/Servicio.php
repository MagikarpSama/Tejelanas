<?php
class Servicio {
    private static $servicios = [
        ["id" => 1, "nombre" => "Consultoría Inicial", "descripcion" => "Evaluación inicial de las necesidades del cliente."],
        ["id" => 2, "nombre" => "Desarrollo de Estrategia", "descripcion" => "Creación de un plan estratégico personalizado."]
    ];

    public static function getAll() {
        return self::$servicios;
    }

    public static function getById($id) {
        foreach (self::$servicios as $servicio) {
            if ($servicio['id'] == $id) return $servicio;
        }
        return null;
    }

    public static function create($data) {
        $nuevo = [
            "id" => count(self::$servicios) + 1,
            "nombre" => $data['nombre'] ?? '',
            "descripcion" => $data['descripcion'] ?? ''
        ];
        self::$servicios[] = $nuevo;
        return $nuevo;
    }

    public static function update($id, $data) {
        foreach (self::$servicios as &$servicio) {
            if ($servicio['id'] == $id) {
                $servicio['nombre'] = $data['nombre'] ?? $servicio['nombre'];
                $servicio['descripcion'] = $data['descripcion'] ?? $servicio['descripcion'];
                return $servicio;
            }
        }
        return null;
    }

    public static function delete($id) {
        foreach (self::$servicios as $i => $servicio) {
            if ($servicio['id'] == $id) {
                array_splice(self::$servicios, $i, 1);
                return true;
            }
        }
        return false;
    }
}