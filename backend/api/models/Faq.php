<?php
class Faq {
    private $db;
    
    public function __construct($db = null) {
        $this->db = $db;
    }
    
    public function obtenerTodos() {
        if ($this->db) {
            try {
                $query = "SELECT id, pregunta, respuesta FROM faqs ORDER BY id";
                $stmt = $this->db->prepare($query);
                $stmt->execute();
                
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return ["error" => $e->getMessage()];
            }
        } else {
            return [
                ["id" => 1, "pregunta" => "¿Realizan envíos?", "respuesta" => "Sí, a Santiago y regiones de Chile a través de Starken y Chilexpress."],
                ["id" => 2, "pregunta" => "¿Dónde están ubicados?", "respuesta" => "En Laguna de Zapallar."]
            ];
        }
    }
    
    public function obtenerPorId($id) {
        
    }
}