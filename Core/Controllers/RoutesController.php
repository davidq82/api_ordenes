<?php

class ControllerRoutes{

    /*=============================================
      CLIENTES
     =============================================*/
	public function manejarClientes($ruta, $metodo)
    {
        if ($ruta === 'clientes') {
            switch ($metodo) {
                case 'GET':
                    isset($_GET["id"]) ? 
                        ControladorClientes::ctrMostrarClientes("id", $_GET["id"]) : 
                        ControladorClientes::ctrMostrarClientes(null, null);
                    break;
                case 'POST':
                    ControladorClientes::ctrCrearCliente();
                    break;
                case 'PUT':
                    parse_str(file_get_contents("php://input"), $_PUT);
                    $_POST = $_PUT;
                    ControladorClientes::ctrEditarCliente();
                    break;
                case 'DELETE':
                    ControladorClientes::ctrEliminarCliente();
                    break;
                default:
                    echo json_encode(["message" => "Método no permitido para esta ruta"]);
            }
        }
    }
 
    /*=============================================
      ZONAS
     =============================================*/
    public function manejarZonas($ruta, $metodo)
    {
        if ($ruta === 'zonas') {
            switch ($metodo) {
                case 'GET':
                    isset($_GET["id"]) ? 
                        ControladorZonas::ctrMostrarZonas("id", $_GET["id"]) : 
                        ControladorZonas::ctrMostrarZonas(null, null);
                    break;
                case 'POST':
                    ControladorZonas::ctrAgregarZona(null, null);
                    break;
                case 'PUT':
                    parse_str(file_get_contents("php://input"), $_PUT);
                    $_POST = $_PUT;
                    ControladorZonas::ctrEditarZona(null, null);
                    break;
                case 'DELETE':
                    ControladorZonas::ctrEliminarZona(null, null);
                    break;
                default:
                    echo json_encode(["message" => "Método no permitido para esta ruta"]);
            }
        }
    }
 
    /*=============================================
      ORDENES
     =============================================*/
    public function manejarOrdenes($ruta, $metodo)
    {
        if ($ruta === 'ordenes') {
            switch ($metodo) {
                case 'GET':
                    isset($_GET["id"]) ? 
                        ControladorOrdenes::ctrMostrarOrdenes("id", $_GET["id"]) : 
                        ControladorOrdenes::ctrMostrarOrdenes(null, null);
                    break;
                case 'POST':
                    ControladorOrdenes::ctrCrearOrden();
                    break;
                case 'PUT':
                    parse_str(file_get_contents("php://input"), $_PUT);
                    $_POST = $_PUT;
                    ControladorOrdenes::ctrEditarOrden();
                    break;
                case 'DELETE':
                    ControladorOrdenes::ctrEliminarOrden();
                    break;
                default:
                    echo json_encode(["message" => "Método no permitido para esta ruta"]);
            }
        }
    }

     /*=============================================
      USUARIOS
     =============================================*/
     public function manejarUsuarios($ruta, $metodo)
     {
         if ($ruta === 'usuarios') {
             switch ($metodo) {
                 case 'GET':
                     isset($_GET["id"]) ? 
                         ControllerUsuarios::ctrMostrarUsuario("id", $_GET["id"]) : 
                         ControllerUsuarios::ctrMostrarUsuario(null, null);
                     break;
                 case 'POST':
                     ControllerUsuarios::ctrCrearUsuario(null, null);
                     break;
                 case 'PUT':
                     parse_str(file_get_contents("php://input"), $_PUT);
                     $_POST = $_PUT;
                     ControllerUsuarios::ctrEditarUsuario(null, null);
                     break;
                 case 'DELETE':
                     ControllerUsuarios::ctrEliminarUsuario(null, null);
                     break;
                 default:
                     echo json_encode(["message" => "Método no permitido para esta ruta"]);
             }
         }
     }
     
    
    /*=============================================
      RUTAS
     =============================================*/
	static public function ctrRoute(){

		include "Core/Routes/Rutas.php";

	}	

    
}