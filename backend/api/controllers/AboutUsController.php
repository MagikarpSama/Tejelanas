<?php
require_once __DIR__ . '/../models/AboutUs.php';

class AboutUsController {
    public static function index() {
        $info = AboutUs::getInfo();
        echo json_encode(['data' => ['descripcion' => $info]]);
    }
}