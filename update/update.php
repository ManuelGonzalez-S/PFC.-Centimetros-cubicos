<?php

require_once('../database.php');

$database = new Database();
$tabla = $_POST['tabla'];
$k=1;
$cabeceras = $database->switchTabla($tabla);

// $database -> update($valores);

$valores = [];
    foreach ($cabeceras as $dato){
        if ($cabeceras != "id" && !(str_contains($dato, "_id")) ){
        array_push($valores, $_POST[$dato]);
        } 
        else {
        if (str_contains($dato, "_id")){
            array_push($valores, $_POST['idAux'.$k]);
        }
        }
    }
$id = $_POST['id'];

var_dump($valores);
print $tabla;


$database->update($tabla, $cabeceras, $valores, $id);
header('Location: ../admin/admin.php?tabla='. $tabla);
 ?>