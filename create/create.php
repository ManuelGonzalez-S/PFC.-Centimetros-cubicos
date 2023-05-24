<?php

function camposBD($tabla)
{
    switch ($tabla) {
        case "equipos":
            $cabeceras = [ "nombre", "Puntos", "poles", "podios", "titulos", "victorias"];
            break;
        case "pilotos":
            $cabeceras = ["nombre", "Puntos", "Dorsal", "nacionalidad", "Equipos_id"];
            break;
        case "coches":
            $cabeceras = ["nombre", "Modelo", "Motor", "Pilotos_id", "Equipos_id"];
            break;
        case "circuitos":
            $cabeceras = ["nombre", "Longitud", "Numero_de_curvas", "Temporada_id"];
            break;
        case "patrocinadores":
            $cabeceras = ["nombre", "Equipos_id"];
            break;
    };

    return $cabeceras;
}

function cogerValores($tabla){

    switch ($tabla) {
        case "equipos":
            $cabeceras = ["'".$_POST['nombre']."'",$_POST['puntos'], $_POST['poles'], $_POST['podios'], $_POST['titulos'], $_POST['victorias']];
            break;
        case "pilotos":
            $cabeceras = ["'".$_POST['nombre']."'", $_POST['puntos'], $_POST['dorsal'],"'". $_POST['nacionalidad']."'", $_POST['id_foranea']];
            break;
        case "coches":
            $cabeceras = ["'".$_POST['nombre']."'", "'".$_POST['modelo']."'", "'".$_POST['motor']."'", $_POST['piloto_id'], $_POST['equipo_id']];
            break;
        case "circuitos":
            $cabeceras = ["'".$_POST['nombre']."'", "'".$_POST['longitud']."'", $_POST['numero_de_curvas'], $_POST['id_foranea']];
            break;
        case "patrocinadores":
            $cabeceras = ["'".$_POST['nombre']."'", $_POST['id_foranea']];
            break;
    };

    return $cabeceras;

}
    
    $tabla = $_POST['tabla'];

    $sql = "INSERT INTO $tabla (";

    $cabeceras = camposBD($tabla);

    $valores = cogerValores($tabla);

    foreach($cabeceras as $item){
        $sql.= "$item, ";
    }

    $sql = substr($sql,0, -2);

    $sql = $sql . ') VALUES (';

    foreach($valores as $item){
        $sql.= "$item, ";
    }

    $sql = substr($sql,0, -2);

    $sql = $sql . ");";

    require_once('../database.php');
    $db = new Database();

    $db->ejecutarSql($sql);

    header("Location: ../admin/admin.php?tabla=$tabla");

?>