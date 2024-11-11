<?php

require_once __DIR__ . '/../../vendor/autoload.php'; // Ajusta la ruta según la ubicación de tu archivo Conexion.php

class Conexion {

    static public function conectar() {

        // Carga las variables del archivo .env
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..'); // Asume que .env está en la carpeta padre
        $dotenv->load();

        $host = $_ENV['REMOTE_DB_HOST'];
        $dbname = $_ENV['REMOTE_DB_NAME'];
        $username = $_ENV['REMOTE_DB_USER'];
        $password = $_ENV['REMOTE_DB_PASS'];

        $link = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $link->exec("set names utf8");

        return $link;
    }
 
}


