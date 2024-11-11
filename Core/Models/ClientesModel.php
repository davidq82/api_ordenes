<?php

require_once "Database.php";

class ModeloClientes
{

    /*=============================================
    CREAR CLIENTE
    =============================================*/
    static public function mdlIngresarCliente($tabla, $datos)
    {

        try {
            // Preparar la llamada al procedimiento almacenado
            $stmt = Conexion::conectar()->prepare("CALL insertar_cliente(:nombre, :direccion, :telefono, :localidad, :email, :num_cable, :est_cable, :num_internet, :est_internet, :id_zona)");

            // Vincular los parámetros
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            $stmt->bindParam(":localidad", $datos["localidad"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $stmt->bindParam(":num_cable", $datos["num_cable"], PDO::PARAM_STR);
            $stmt->bindParam(":est_cable", $datos["est_cable"], PDO::PARAM_STR);
            $stmt->bindParam(":num_internet", $datos["num_internet"], PDO::PARAM_STR);
            $stmt->bindParam(":est_internet", $datos["est_internet"], PDO::PARAM_STR);
            $stmt->bindParam(":id_zona", $datos["id_zona"], PDO::PARAM_STR);

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
    MOSTRAR CLIENTES
    =============================================*/
    static public function mdlMostrarClientes($tabla, $item, $valor)
    {

        // Si no se filtra por un campo específico (item)
        if ($item == null) {

            $stmt = Conexion::conectar()->prepare("CALL listar_clientes()");

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
    EDITAR CLIENTE
    =============================================*/
    static public function mdlActualizarCliente($tabla, $datos)
    {
        try {
            // Preparar la llamada al procedimiento almacenado
            $stmt = Conexion::conectar()->prepare("CALL editar_cliente(:id,:nombre, :direccion, :telefono, :localidad, :email, :num_cable, :est_cable, :num_internet, :est_internet, :id_zona)");

            // Vincular los parámetros
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            $stmt->bindParam(":localidad", $datos["localidad"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $stmt->bindParam(":num_cable", $datos["num_cable"], PDO::PARAM_STR);
            $stmt->bindParam(":est_cable", $datos["est_cable"], PDO::PARAM_STR);
            $stmt->bindParam(":num_internet", $datos["num_internet"], PDO::PARAM_STR);
            $stmt->bindParam(":est_internet", $datos["est_internet"], PDO::PARAM_STR);
            $stmt->bindParam(":id_zona", $datos["id_zona"], PDO::PARAM_STR);

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
    BORRAR CLIENTE
    =============================================*/
    static public function mdlEliminarCliente($tabla, $id)
    {
        $stmt = Conexion::conectar()->prepare("CALL eliminar_cliente(:id)");

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
