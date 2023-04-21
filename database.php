<?php

    class database{

        public static function conectar(){
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

        public function getTabla($tabla){
            $sql = "SELECT * FROM $tabla";
            $resultados = self::conectar()->query($sql);
            return $resultados;
        }

        function getPilotosEquipos(){

            $sql = "select pilotos.*,equipos.nombre as 'nombreEquipo' from pilotos inner join equipos on equipos.id = pilotos.equipos_id order by pilotos.Puntos desc;";
            $resultados = self::conectar()->query($sql);
            return $resultados;
        
        }

        function getTablaenBaseAID($tabla,$id,$limit){
            $sql = "select * from $tabla where id = $id limit $limit;";
            $resultados = self::conectar()->query($sql);
            return $resultados;
        }

        function getTablaSegunCampoID($tabla,$campo,$id,$limit){
            $sql = "select * from $tabla where $campo = $id limit $limit;";
            $resultados = self::conectar()->query($sql);
            return $resultados;
        }

        function getNumeroEquipos(){
            $sql = "select count(*) as 'suma' from equipos;";
            $resultados = self::conectar()->query($sql);
            return $resultados;
        }

    }