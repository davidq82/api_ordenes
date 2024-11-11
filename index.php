<?php

require_once "Core/Controllers/RoutesController.php";
require_once "Core/Controllers/ClientesController.php";
require_once "Core/Controllers/ZonasController.php";
require_once "Core/Controllers/OrdenesController.php";
require_once "Core/Controllers/UsuariosController.php";


require_once "Core/Models/ClientesModel.php";
require_once "Core/Models/ZonasModel.php";
require_once "Core/Models/OrdenesModel.php";
require_once "Core/Models/UsuariosModel.php";

require_once "Core/Routes/Rutas.php";



require_once 'Core/Config/ApiKeyManager.php';


// Instanciar la clase Rutas para manejar las peticiones

$ruta = new Rutas();
$ruta->manejarRutas();
