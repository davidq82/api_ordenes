<?php

require_once "Database.php";

class ModeloOrden
{

    /*=============================================
    CREAR ORDEN
    =============================================*/
    static public function mdlIngresarOrden($tabla, $datos)
    {
        try {
            // Preparar la llamada al procedimiento almacenado
            $stmt = Conexion::conectar()->prepare("CALL insertar_orden(:fecha, :id_tecnico, :num_cable, :est_cable, :num_internet, :est_internet, :cliente, :emp_servicio, :observaciones, :zona, :hora_turno, :id_resolucion, :obs_resolucion)");

            // Vincular los parámetros
            $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
            $stmt->bindParam(":id_tecnico", $datos["id_tecnico"], PDO::PARAM_INT);
            $stmt->bindParam(":num_cable", $datos["num_cable"], PDO::PARAM_INT);
            $stmt->bindParam(":est_cable", $datos["est_cable"], PDO::PARAM_STR);
            $stmt->bindParam(":num_internet", $datos["num_internet"], PDO::PARAM_INT);
            $stmt->bindParam(":est_internet", $datos["est_internet"], PDO::PARAM_STR);
            $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
            $stmt->bindParam(":emp_servicio", $datos["emp_servicio"], PDO::PARAM_STR);
            $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
            $stmt->bindParam(":zona", $datos["zona"], PDO::PARAM_INT);
            $stmt->bindParam(":hora_turno", $datos["hora_turno"], PDO::PARAM_STR);
            $stmt->bindParam(":id_resolucion", $datos["id_resolucion"], PDO::PARAM_INT);
            $stmt->bindParam(":obs_resolucion", $datos["obs_resolucion"], PDO::PARAM_STR);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error: " . implode(", ", $stmt->errorInfo());
            }
        } catch (Exception $e) {
            return "error: " . $e->getMessage();
        } finally {
            // Cerrar la conexión
            $stmt = null;
        }
    }

    /*=============================================
    MOSTRAR ORDENES
    =============================================*/
    static public function mdlMostrarOrdenes($tabla, $item, $valor)
    {

        // Si no se filtra por un campo específico (item)
        if ($item == null) {

            $stmt = Conexion::conectar()->prepare("CALL listar_ordenes()");

            $stmt->execute();

            return $stmt->fetchAll();
        } else {

            // Si se desea filtrar por un campo específico (por ejemplo, por id o nombre)

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    EDITAR ORDEN
    =============================================*/
    static public function mdlEditarOrden($tabla, $datos)
    {
        try {
            // Preparar la llamada al procedimiento almacenado
            $stmt = Conexion::conectar()->prepare("CALL Editar_orden(:id, :fecha, :id_tecnico, :num_cable, :est_cable, :num_internet, :est_internet, :cliente, :emp_servicio, :observaciones, :zona, :hora_turno, :id_resolucion, :obs_resolucion)");

            // Vincular los parámetros
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
            $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
            $stmt->bindParam(":id_tecnico", $datos["id_tecnico"], PDO::PARAM_INT);
            $stmt->bindParam(":num_cable", $datos["num_cable"], PDO::PARAM_INT);
            $stmt->bindParam(":est_cable", $datos["est_cable"], PDO::PARAM_STR);
            $stmt->bindParam(":num_internet", $datos["num_internet"], PDO::PARAM_INT);
            $stmt->bindParam(":est_internet", $datos["est_internet"], PDO::PARAM_STR);
            $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
            $stmt->bindParam(":emp_servicio", $datos["emp_servicio"], PDO::PARAM_STR);
            $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
            $stmt->bindParam(":zona", $datos["zona"], PDO::PARAM_INT);
            $stmt->bindParam(":hora_turno", $datos["hora_turno"], PDO::PARAM_STR);
            $stmt->bindParam(":id_resolucion", $datos["id_resolucion"], PDO::PARAM_INT);
            $stmt->bindParam(":obs_resolucion", $datos["obs_resolucion"], PDO::PARAM_STR);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error: " . implode(", ", $stmt->errorInfo());
            }
        } catch (Exception $e) {
            return "error: " . $e->getMessage();
        } finally {
            // Cerrar la conexión
            $stmt = null;
        }
    }

    /*=============================================
    BORRAR ORDEN
    =============================================*/
    static public function mdlEliminarOrden($tabla, $id)
    {
        $stmt = Conexion::conectar()->prepare("CALL eliminar_orden(:id)");

        // Enlazar el parámetro
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null; // Cerrar la conexión correctamente
    }
}
