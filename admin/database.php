<?php

class Database
{

    public function conectar()
    {
        $driver = "mysql"; // Que tipo de base de datos voy a utilizar.
        $host = 'localhost'; // 127.0.0.1
        $port = '3306';
        $bd = 'centimetroscubicos';
        $user = 'root'; // Esto tiene que cambiar, se crea uno nuevo con permisos.
        $password = ""; // Esto tambien cambia

        /* Conectar a una base de datos de MySQL invocando al controlador */
        $dsn = "$driver:dbname=$bd;host=$host;port=$port";
        try {
            $gbd = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }

        return $gbd;
    }

    public function getTabla($tabla)
    {
        $sql = "SELECT * FROM $tabla;";
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }

}