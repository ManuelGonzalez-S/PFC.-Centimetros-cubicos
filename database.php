<?php

class database
{

    public static function conectar()
    {
        $driver = 'mysql'; // Que tipo de base de datos voy a utilizar
        $host = 'localhost';
        $port = '3306';
        $bd = 'centimetroscubicos';
        $user = 'root'; //Cambiar a uno nuevo con permisos
        $password = ''; // Esto tambien cambia

        $dsn = "$driver:dbname=$bd;host=$host;port=$port";

        try {
            $gbd = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Falló la conexion; ' . $e->getMessage();
        }

        return $gbd;
    }

    public function getTabla($tabla)
    {
        if ($tabla != null) {
            $sql = "SELECT * FROM $tabla";
            $resultados = self::conectar()->query($sql);
            return $resultados;
        }
    }

    public function getTablaToArray($tabla)
    {
        if ($tabla != null) {
            $sql = "SELECT * FROM $tabla";
            $resultados = self::conectar()->query($sql);
            return $resultados->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    function getPilotosEquipos()
    {

        $sql = "select pilotos.*,equipos.nombre as 'nombreEquipo' from pilotos inner join equipos on equipos.id = pilotos.equipos_id order by pilotos.Puntos desc;";
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }

    function getTablaenBaseAID($tabla, $id, $limit)
    {
        $sql = "select * from $tabla where id = $id limit $limit;";
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }

    function getTablaSegunCampoID($tabla, $campo, $id, $limit)
    {
        $sql = "select * from $tabla where $campo = $id limit $limit;";
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }

    function getNumeroEquipos()
    {
        $sql = "select count(*) as 'suma' from equipos;";
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }

    function getEquiposClasi()
    {
        $sql = 'select * from equipos order by puntos desc;';
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }

    function ejecutarSql($sql){

        if ($sql != null) {
            $resultados = self::conectar()->query($sql);

            return $resultados;
        }

    }

    function getTablaID($tabla, $id)
    {
        $sql = "select * from $tabla where id = $id;";
        $resultados = self::conectar()->query($sql);
        return $resultados->fetch(PDO::FETCH_ASSOC);
    }

    function getMaxId($tabla){
        $sql = "select max(id) from $tabla;";
        $resultados = self::conectar()->query($sql);
        return $resultados->fetch(PDO::FETCH_ASSOC);
    }

    function getIds($tabla){
        $sql = "select id from $tabla;";
        $resultados = self::conectar()->query($sql);
        return $resultados->fetch(PDO::FETCH_ASSOC);
    }
}
