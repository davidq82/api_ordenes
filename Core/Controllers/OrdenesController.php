<?php


class ControladorOrdenes

{

    /*=============================================
     CREAR ORDEN
     =============================================*/
    static public function ctrCrearOrden()
    {
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);

        // Verificar los campos requeridos según los parámetros del procedimiento almacenado
        if (
            isset($data["fecha"]) && isset($data["id_tecnico"]) &&
            isset($data["num_cable"]) && isset($data["est_cable"]) &&
            isset($data["num_internet"]) && isset($data["est_internet"]) &&
            isset($data["cliente"]) && isset($data["emp_servicio"]) &&
            isset($data["observaciones"]) && isset($data["zona"]) &&
            isset($data["hora_turno"]) && isset($data["id_resolucion"]) &&
            isset($data["obs_resolucion"])
        ) {
            $tabla = "ordenes";

            $respuesta = ModeloOrden::mdlIngresarOrden($tabla, $data);

            echo json_encode(array(
                "status" => $respuesta == "ok" ? "success" : "error",
                "message" => $respuesta == "ok" ? "Orden creada correctamente" : "Error al crear la orden"
            ));
        } else {
            echo json_encode(array("status" => "error", "message" => "Faltan campos requeridos en la petición"));
        }
    }

    /*=============================================
    EDITAR ORDEN
    =============================================*/
    static public function ctrEditarOrden()
    {
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);

        // Verificar que los datos contienen el campo "id" y los demás parámetros
        if (
            isset($data["id"]) && isset($data["fecha"]) && isset($data["id_tecnico"]) &&
            isset($data["num_cable"]) && isset($data["est_cable"]) &&
            isset($data["num_internet"]) && isset($data["est_internet"]) &&
            isset($data["cliente"]) && isset($data["emp_servicio"]) &&
            isset($data["observaciones"]) && isset($data["zona"]) &&
            isset($data["hora_turno"]) && isset($data["id_resolucion"]) &&
            isset($data["obs_resolucion"])
        ) {
            $tabla = "ordenes";

            $respuesta = ModeloOrden::mdlEditarOrden($tabla, $data);

            echo json_encode(array(
                "status" => $respuesta == "ok" ? "success" : "error",
                "message" => $respuesta == "ok" ? "Orden actualizada correctamente" : "Error al actualizar la orden"
            ));
        } else {
            echo json_encode(array("status" => "error", "message" => "Faltan campos requeridos en la petición"));
        }
    }


    /*=============================================
    MOSTRAR ORDEN
    =============================================*/
    static public function ctrMostrarOrdenes($item, $valor)
    {

        $tabla = "ordenes";

        $respuesta = ModeloOrden::mdlMostrarOrdenes($tabla, $item, $valor);

        // Respuesta JSON
        echo json_encode($respuesta);
    }

    /*=============================================
    ELIMINAR ORDEN
    =============================================*/
    static public function ctrEliminarOrden()
    {
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);

        // Verifica que se reciba el ID del cliente
        if (isset($data["id"])) {
            $tabla = "ordenes";

            // Llamar al modelo para eliminar el cliente
            $respuesta = ModeloOrden::mdlEliminarOrden($tabla, $data["id"]);

            // Respuesta en formato JSON
            echo json_encode(array(
                "status" => $respuesta == "ok" ? "success" : "error",
                "message" => $respuesta == "ok" ? "Orden eliminada correctamente" : "Error al eliminar la  orden"
            ));
        } else {
            echo json_encode(array("status" => "error", "message" => "Falta el campo 'id' en la petición"));
        }
    }
}
