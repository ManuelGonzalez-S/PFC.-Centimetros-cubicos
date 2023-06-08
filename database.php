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
        $sql = "select count(*) as 'suma' from 15_equipos;";
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }

    function getEquiposClasi()
    {
        $sql = 'select * from 15_equipos order by puntos desc;';
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

    public function switchTabla($tabla)
    {
        switch ($tabla) {
            case "15_equipos":
                $cabeceras = ["id", "Puntos", "nombre", "poles", "podios", "titulos", "victorias"];
                break;
            case "15_pilotos":
                $cabeceras = ["id", "nombre", "Puntos", "Dorsal", "nacionalidad", "equipos_id"];
                break;
            case "15_coches":
                $cabeceras = ["id", "nombre", "Modelo", "Motor", "pilotos_id", "equipos_id"];
                break;
            case "15_circuitos":
                $cabeceras = ["id", "nombre", "Longitud", "Numero_de_curvas", "Temporadas_id"];
                break;
            case "15_patrocinadores":
                $cabeceras = ["id", "nombre", "equipos_id"];
                break;
            case "15_noticias":
                $cabeceras = ["id", "titulo", "descripcion", "rutaImagen"];
                break;
        }
        ;
        return $cabeceras;
    }

    function getListaForeign($tabla)
    {
        $sql = "SELECT nombre,id FROM $tabla;";
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }

    public function getById($tabla, $id)
    {
        $sql = "SELECT * FROM $tabla WHERE id = $id";
        $resultados = self::conectar()->query($sql);
        return $resultados->fetch(PDO::FETCH_ASSOC);
    }

    public function update($tabla, $cabeceras, $valores, $id)
    {
        $i = 1;
        $sql = "UPDATE $tabla SET ";
        foreach ($cabeceras as $elemento) {
            if ($elemento != "id" && !(str_contains($elemento[$i], "_id"))) {
                $sql = $sql . "$elemento='$valores[$i]',";
                $i++;
            }
        }
        $sql = substr($sql, 0, -1);
        $sql = $sql . " WHERE id = $id";
        self::conectar()->query($sql);
    }

    function getPilotosEquipos()
    {

        $sql = "select 15_pilotos.*,15_equipos.nombre as 'nombreEquipo' from 15_pilotos inner join 15_equipos on 15_equipos.id = 15_pilotos.equipos_id order by 15_pilotos.Puntos desc;";
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }

    function getPilotosEquipos2()
    {
        $sql = "select 15_pilotos.*,15_equipos.nombre as 'Equipo' from 15_pilotos inner join 15_equipos on 15_equipos.id = 15_pilotos.equipos_id ORDER BY id;";
        $resultados = self::conectar()->query($sql);
        return $resultados;

    }

    function getConductorEquipo()
    {
        $sql = "SELECT 15_coches.*,15_pilotos.nombre as 'piloto' ,15_equipos.nombre as 'Equipo' FROM
            15_coches inner join 15_pilotos on 15_coches.pilotos_id = 15_pilotos.id
            inner join 15_equipos on 15_coches.equipos_id = 15_equipos.id ORDER BY id;";
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }

    function getEquipoCircuito()
    {
        $sql = "SELECT 15_circuitos.*, 15_temporadas.nombre as 'Temporada' FROM 15_circuitos
            INNER JOIN 15_temporadas on 15_circuitos.temporadas_id = 15_temporadas.id;";
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }

    function getEquipoPatrocinado()
    {
        $sql = "SELECT 15_patrocinadores.*, 15_equipos.nombre as 'Equipo' FROM 15_patrocinadores
            INNER JOIN 15_equipos on 15_patrocinadores.Equipos_id = 15_equipos.id;";
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }

    function getNullEquipos($tabla)
    {
        $sql = "SELECT * FROM $tabla WHERE Equipos_id = 0";
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }

    function getNullPilotos($tabla)
    {
        $sql = "SELECT * FROM $tabla WHERE Pilotos_id = 0 or Equipos_id = 0";
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }

    function getLongitudPilotosNull($tabla)
    {
        $sql = "SELECT count(*) as 'longitud' FROM ($tabla) WHERE Pilotos_id = 0 or Equipos_id = 0";
        $resultados = self::conectar()->query($sql);
        return $resultados->fetch(PDO::FETCH_ASSOC)['longitud'];
    }

    function getLongitudEquiposNull($tabla)
    {
        $sql = "SELECT count(*) as 'longitud' FROM ($tabla) WHERE Equipos_id = 0";
        $resultados = self::conectar()->query($sql);
        return $resultados->fetch(PDO::FETCH_ASSOC)['longitud'];
    }

    public function delete($tabla, $id)
    {

        $sql = "DELETE FROM $tabla WHERE id = $id";
        self::conectar()->query($sql);
    }
}
