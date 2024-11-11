<?php

require_once "Database.php";


class ModeloUsuarios
{

    /*=============================================
    MOSTRAR USUARIOS
    =============================================*/
    static public function mdlMostrarUsuarios($tabla, $item, $valor)
    {

        // Si no se filtra por un campo específico (item)
        if ($item == null) {

            $stmt = Conexion::conectar()->prepare("CALL listar_usuarios()");

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
    CREAR USUARIO
    =============================================*/
    static public function mdlIngresarUsuario($tabla, $datos)
    {
        try {
            // Preparar la llamada al procedimiento almacenado
            $stmt = Conexion::conectar()->prepare("CALL insertar_usuario(:nombre, :usuario, :password, :perfil, :estado)");

            // Vincular los parámetros
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
            $stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
            $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
            
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
    EDITAR USUARIO
    =============================================*/
    static public function mdlEditarUsuario($tabla, $datos)
    {
        try {
            // Preparar la llamada al procedimiento almacenado
            $stmt = Conexion::conectar()->prepare("CALL editar_usuario(:id,:nombre, :usuario, :password, :perfil, :estado)");

            // Vincular los parámetros
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
            $stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
            $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
            
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
    BORRAR USUARIO
    =============================================*/
    static public function mdlEliminarUsuario($tabla, $id)
    {
        $stmt = Conexion::conectar()->prepare("CALL eliminar_usuario(:id)");

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
