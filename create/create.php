<?php

function camposBD($tabla)
{
    switch ($tabla) {
        case "15_equipos":
            $cabeceras = [ "nombre", "Puntos", "poles", "podios", "titulos", "victorias"];
            break;
        case "15_pilotos":
            $cabeceras = ["nombre", "Puntos", "Dorsal", "nacionalidad", "Equipos_id"];
            break;
        case "15_coches":
            $cabeceras = ["nombre", "Modelo", "Motor", "Pilotos_id", "Equipos_id"];
            break;
        case "15_circuitos":
            $cabeceras = ["nombre", "Longitud", "Numero_de_curvas", "temporadas_id"];
            break;
        case "15_patrocinadores":
            $cabeceras = ["nombre", "Equipos_id"];
            break;
        case '15_noticias':
            $cabeceras = ['titulo','descripcion','rutaImagen'];
            break;
    };

    return $cabeceras;
}

function cogerValores($tabla){

    switch ($tabla) {
        case "15_equipos":
            $cabeceras = ["'".$_POST['nombre']."'",$_POST['puntos'], $_POST['poles'], $_POST['podios'], $_POST['titulos'], $_POST['victorias']];
            break;
        case "15_pilotos":
            $cabeceras = ["'".$_POST['nombre']."'", $_POST['puntos'], $_POST['dorsal'],"'". $_POST['nacionalidad']."'", $_POST['id_foranea']];
            break;
        case "15_coches":
            $cabeceras = ["'".$_POST['nombre']."'", "'".$_POST['modelo']."'", "'".$_POST['motor']."'", $_POST['piloto_id'], $_POST['equipo_id']];
            break;
        case "15_circuitos":
            $cabeceras = ["'".$_POST['nombre']."'", "'".$_POST['longitud']."'", $_POST['numero_de_curvas'], $_POST['id_foranea']];
            break;
        case "15_patrocinadores":
            $cabeceras = ["'".$_POST['nombre']."'", $_POST['id_foranea']];
            break;
        case "15_noticias":
            $cabeceras = ["'".$_POST['titulo']."'","'". $_POST['descripcion']."'", "'". $_POST['rutaimagen']."'"];
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