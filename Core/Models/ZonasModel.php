<?php

require_once "Database.php";

class ModeloZonas
{

    /*=============================================
    MOSTRAR ZONA
    =============================================*/
    static public function mdlMostrarZona($tabla, $item, $valor)
    {
        // Si no se filtra por un campo específico (item)
        if ($item == null) {

            $stmt = Conexion::conectar()->prepare("CALL listar_zonas()");

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
    CREAR ZONA
    =============================================*/
    static public function mdlIngresarZona($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("CALL insertar_zona(:nombre)");

        $stmt->bindParam(":nombre", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    EDITAR ZONA
    =============================================*/
    static public function mdlEditarZona($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("CALL editar_zona(:id, :nombre)");

        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);
        $stmt->bindParam(":nombre", $datos, type: PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    BORRAR CLIENTE
    =============================================*/
    static public function mdlEliminarZona($tabla, $id)
    {
        $stmt = Conexion::conectar()->prepare("CALL eliminar_zona(:id)");
    
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
