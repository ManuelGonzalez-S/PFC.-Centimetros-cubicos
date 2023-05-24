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
            $sql = "SELECT * FROM $tabla order BY id";
            $resultados = self::conectar()->query($sql);
            return $resultados;
        }
    }

    public function switchTabla($tabla)
    {
        switch ($tabla) {
            case "equipos":
                $cabeceras = ["id", "Puntos", "nombre", "poles", "podios", "titulos", "victorias"];
                break;
            case "pilotos":
                $cabeceras = ["id", "nombre", "Puntos", "Dorsal", "nacionalidad", "Equipos_id"];
                break;
            case "coches":
                $cabeceras = ["id", "nombre", "Modelo", "Motor", "Pilotos_id", "Equipos_id"];
                break;
            case "circuitos":
                $cabeceras = ["id", "nombre", "Longitud", "Numero_de_curvas", "Temporadas_id"];
                break;
            case "patrocinadores":
                $cabeceras = ["id", "nombre", "Equipos_id"];
                break;
            case "noticias":
                $cabeceras = ["id", "titulo", "descripcion", "rutaImagen", "mostrar"];
                break;
        }
        ;
        return $cabeceras;
    }


    function getPilotosEquipos()
    {

        $sql = "select pilotos.*,equipos.nombre as 'nombreEquipo' from pilotos inner join equipos on equipos.id = pilotos.equipos_id order by pilotos.Puntos desc;";
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }


    function getPilotosEquipos2()
    {
        $sql = "select pilotos.*,equipos.nombre as 'Equipo' from pilotos inner join equipos on equipos.id = pilotos.equipos_id ORDER BY id;";
        $resultados = self::conectar()->query($sql);
        return $resultados;

    }

    function getListaForeign($tabla)
    {
        $sql = "SELECT nombre,id FROM $tabla;";
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }


    function getConductorEquipo()
    {
        $sql = "SELECT coches.*,pilotos.nombre as 'piloto' ,equipos.nombre as 'Equipo' FROM
            coches inner join pilotos on coches.pilotos_id = pilotos.id
            inner join equipos on coches.equipos_id = equipos.id ORDER BY id;";
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }

    function getEquipoPatrocinado()
    {
        $sql = "SELECT patrocinadores.*, equipos.nombre as 'Equipo' FROM patrocinadores
            INNER JOIN equipos on patrocinadores.Equipos_id = equipos.id;";
        $resultados = self::conectar()->query($sql);
        return $resultados;
    }

    function getEquipoCircuito()
    {
        $sql = "SELECT circuitos.*, temporadas.nombre as 'Temporada' FROM circuitos
            INNER JOIN temporadas on circuitos.temporadas_id = temporadas.id;";
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

    function ejecutarSql($sql)
    {
        if ($sql != null) {
            $resultados = self::conectar()->query($sql);
            return $resultados;
        }
    }

    public function delete($tabla, $id)
    {

        $sql = "DELETE FROM $tabla WHERE id = $id";
        self::conectar()->query($sql);
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
            // echo $elemento . '|';
            if ($elemento != "id" && !(str_contains($elemento[$i], "_id"))) {
                $sql = $sql . "$elemento='$valores[$i]',";
                $i++;
            }
        }
        $sql = substr($sql, 0, -1);
        $sql = $sql . " WHERE id = $id";
        self::conectar()->query($sql);
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

}