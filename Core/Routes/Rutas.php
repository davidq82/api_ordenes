<?php

require_once 'Core/Config/ApiKeyManager.php';
require_once 'Core/Controllers/RoutesController.php';
require_once 'Core/Controllers/ZonasController.php';
require_once 'Core/Controllers/OrdenesController.php';
require_once 'Core/Controllers/UsuariosController.php';


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization, API-KEY");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

class Rutas
{
    private $routesController;

    public function __construct()
    {
        $this->routesController = new ControllerRoutes();
    }

    public function manejarRutas()
    {
        $metodo = $_SERVER['REQUEST_METHOD'];
        $apiKey = $_SERVER["HTTP_API_KEY"] ?? "";

        if (empty($apiKey) || !ApiKeyManager::validateApiKey($apiKey)) {
            http_response_code(401);
            echo json_encode(["message" => "Clave API no válida."]);
            exit();
        }

        $ruta = $_GET['ruta'] ?? '/';
        $this->routesController->manejarClientes($ruta, $metodo);
        $this->routesController->manejarZonas($ruta, $metodo);
        $this->routesController->manejarOrdenes($ruta, $metodo);
        $this->routesController->manejarUsuarios($ruta, $metodo);

    }
}
