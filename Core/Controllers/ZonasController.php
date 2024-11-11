<?php

class ControladorZonas

{
    /*=============================================
    MOSTRAR ZONA
    =============================================*/
    static public function ctrMostrarZonas($item, $valor)
    {

        $tabla = "zonas";

        $respuesta = ModeloZonas::mdlMostrarZona($tabla, $item, $valor);

        // Respuesta JSON
        echo json_encode($respuesta);
    }

    /*=============================================
    CREAR ZONA
    =============================================*/
    static public function ctrAgregarZona($item, $valor)
    {
        // Obtener datos en formato JSON desde la petición
        $jsonData = file_get_contents("php://input");

        // Decodificar el JSON a un array asociativo de PHP
        $data = json_decode($jsonData, true);

        // Comprobar si el campo 'nuevoNombre' existe en el array
        if (isset($data["nombre"])) {

            // Validar que el nombre solo contenga caracteres permitidos
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data["nombre"])) {

                $tabla = "zonas";
                $nombreZona = $data["nombre"];

                // Llamar al modelo para ingresar la categoría
                $respuesta = ModeloZonas::mdlIngresarZona($tabla, $nombreZona);

                // Respuesta en formato JSON
                echo json_encode(array(
                    "status" => $respuesta == "ok" ? "success" : "error",
                    "message" => $respuesta == "ok" ? "Zona creada correctamente" : "Error al crear la zona"
                ));
            } else {
                // Error de validación
                echo json_encode(array("status" => "error", "message" => "La zona no puede llevar caracteres especiales o estar vacía"));
            }
        } else {
            // Si falta el campo 'nuevoNombre'
            echo json_encode(array("status" => "error", "message" => "Falta el campo 'Numero' en la petición"));
        }
    }

    /*=============================================
    EDITAR ZONA
    =============================================*/
    static public function ctrEditarZona($item, $valor)
    {
        // Obtener datos en formato JSON desde la petición
        $jsonData = file_get_contents("php://input");

        // Decodificar el JSON a un array asociativo de PHP
        $data = json_decode($jsonData, true);

        // Comprobar si el campo 'nuevoNombre' existe en el array
        if (isset($data["nombre"])) {

            // Validar que el nombre solo contenga caracteres permitidos
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data["nombre"])) {

                $tabla = "zonas";
                $nombreZona = $data["nombre"];

                // Llamar al modelo para ingresar la categoría
                $respuesta = ModeloZonas::mdlEditarZona($tabla, $nombreZona);

                // Respuesta en formato JSON
                echo json_encode(array(
                    "status" => $respuesta == "ok" ? "success" : "error",
                    "message" => $respuesta == "ok" ? "Zona actualizada correctamente" : "Error al actualizar la zona"
                ));
            } else {
                // Error de validación
                echo json_encode(array("status" => "error", "message" => "La zona no puede llevar caracteres especiales o estar vacía"));
            }
        } else {
            // Si falta el campo 'nuevoNombre'
            echo json_encode(array("status" => "error", "message" => "Falta el campo 'Numero' en la petición"));
        }
    }

    /*=============================================
    ELIMINAR ZONA
    =============================================*/
    static public function ctrEliminarZona()
    {
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);

        // Verifica que se reciba el ID del cliente
        if (isset($data["id"])) {
            $tabla = "zonas";

            // Llamar al modelo para eliminar el cliente
            $respuesta = ModeloClientes::mdlEliminarCliente($tabla, $data["id"]);

            // Respuesta en formato JSON
            echo json_encode(array(
                "status" => $respuesta == "ok" ? "success" : "error",
                "message" => $respuesta == "ok" ? "Zona eliminada correctamente" : "Error al eliminar la zona"
            ));
        } else {
            echo json_encode(array("status" => "error", "message" => "Falta el campo 'id' en la petición"));
        }
    }


}
