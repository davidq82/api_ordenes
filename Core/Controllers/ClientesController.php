<?php


class ControladorClientes

{

    /*=============================================
     CREAR CLIENTE
     =============================================*/
    static public function ctrCrearCliente()
    {
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);

        // Verificar los campos requeridos según los parámetros del procedimiento almacenado
        if (
            isset($data["nombre"]) && isset($data["direccion"]) &&
            isset($data["telefono"]) && isset($data["localidad"]) &&
            isset($data["email"]) && isset($data["num_cable"]) &&
            isset($data["est_cable"]) && isset($data["num_internet"]) &&
            isset($data["est_internet"]) && isset($data["id_zona"])
        ) {
            $tabla = "clientes";

            $respuesta = ModeloClientes::mdlIngresarCliente($tabla, $data);

            echo json_encode(array(
                "status" => $respuesta == "ok" ? "success" : "error",
                "message" => $respuesta == "ok" ? "Ciente creado correctamente" : "Error al crear el cliente"
            ));
        } else {
            echo json_encode(array("status" => "error", "message" => "Faltan campos requeridos en la petición"));
        }
    }

    /*=============================================
    EDITAR CLIENTE
    =============================================*/
    static public function ctrEditarCliente()
    {
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);

        // Verificar los campos requeridos según los parámetros del procedimiento almacenado
        if (
            isset($data["id"]) &&
            isset($data["nombre"]) && isset($data["direccion"]) &&
            isset($data["telefono"]) && isset($data["localidad"]) &&
            isset($data["email"]) && isset($data["num_cable"]) &&
            isset($data["est_cable"]) && isset($data["num_internet"]) &&
            isset($data["est_internet"]) && isset($data["id_zona"])
        ) {
            $tabla = "clientes";

            $respuesta = ModeloClientes::mdlActualizarCliente($tabla, $data);

            echo json_encode(array(
                "status" => $respuesta == "ok" ? "success" : "error",
                "message" => $respuesta == "ok" ? "Ciente actualizado correctamente" : "Error al actualizar el cliente"
            ));
        } else {
            echo json_encode(array("status" => "error", "message" => "Faltan campos requeridos en la petición"));
        }
    }

    /*=============================================
    MOSTRAR CLIENTE
    =============================================*/
    static public function ctrMostrarClientes($item, $valor)
    {

        $tabla = "clientes";

        $respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

        // Respuesta JSON
        echo json_encode($respuesta);
    }

    /*=============================================
    ELIMINAR CLIENTE
    =============================================*/
    static public function ctrEliminarCliente()
    {
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);

        // Verifica que se reciba el ID del cliente
        if (isset($data["id"])) {
            $tabla = "clientes";

            // Llamar al modelo para eliminar el cliente
            $respuesta = ModeloClientes::mdlEliminarCliente($tabla, $data["id"]);

            // Respuesta en formato JSON
            echo json_encode(array(
                "status" => $respuesta == "ok" ? "success" : "error",
                "message" => $respuesta == "ok" ? "Cliente eliminado correctamente" : "Error al eliminar el cliente"
            ));
        } else {
            echo json_encode(array("status" => "error", "message" => "Falta el campo 'id' en la petición"));
        }
    }
}
