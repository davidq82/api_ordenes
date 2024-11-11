<?php

class ControllerUsuarios
{

    /*=============================================
    MOSTRAR USUARIOS
    =============================================*/
    public static function ctrMostrarUsuario($item, $valor)
    {

        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

        // Respuesta JSON
        echo json_encode($respuesta);
    }

    /*=============================================
     CREAR USUARIO
     =============================================*/
    static public function ctrCrearUsuario()
    {
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);

        // Verificar los campos requeridos según los parámetros del procedimiento almacenado
        if (
            isset($data["nombre"]) && isset($data["usuario"]) 
        ) {
            $tabla = "usuarios";

            $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $data);

            echo json_encode(array(
                "status" => $respuesta == "ok" ? "success" : "error",
                "message" => $respuesta == "ok" ? "Usuario creado correctamente" : "Error al crear el usuario"
            ));
        } else {
            echo json_encode(array("status" => "error", "message" => "Faltan campos requeridos en la petición"));
        }
    }

     /*=============================================
     EDITAR USUARIO
     =============================================*/
     static public function ctrEditarUsuario()
     {
         $jsonData = file_get_contents("php://input");
         $data = json_decode($jsonData, true);
 
         // Verificar los campos requeridos según los parámetros del procedimiento almacenado
         if (
             isset($data["nombre"]) && isset($data["usuario"]) 
         ) {
             $tabla = "usuarios";
 
             $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $data);
 
             echo json_encode(array(
                 "status" => $respuesta == "ok" ? "success" : "error",
                 "message" => $respuesta == "ok" ? "Usuario editado correctamente" : "Error al editar el usuario"
             ));
         } else {
             echo json_encode(array("status" => "error", "message" => "Faltan campos requeridos en la petición"));
         }
     }

    /*=============================================
    ELIMINAR USUARIO
    =============================================*/
    static public function ctrEliminarUsuario()
    {
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);

        // Verifica que se reciba el ID del cliente
        if (isset($data["id"])) {
            $tabla = "usuarios";

            // Llamar al modelo para eliminar el cliente
            $respuesta = ModeloUsuarios::mdlEliminarUsuario($tabla, $data["id"]);

            // Respuesta en formato JSON
            echo json_encode(array(
                "status" => $respuesta == "ok" ? "success" : "error",
                "message" => $respuesta == "ok" ? "Usuario eliminado correctamente" : "Error al eliminar el usuario"
            ));
        } else {
            echo json_encode(array("status" => "error", "message" => "Falta el campo 'id' en la petición"));
        }
    }
 


}
