<?php
session_start();

if(isset($_SESSION['user'])){

    if($_SESSION['user']['permisos'] == '0'){
        header('Location: ../index/index.php');
    }

}else{
    header('Location: ../index/index.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $tabla = $_GET['tabla'];

    //2.  Importar la clase Database para poder usar sus funciones
    require_once('../Database.php');

    // Realizar un nuevo objeto de la clase Database para usar la funcion getAll
    $database = new Database();
    $tablas = $database->getByid($tabla, $id);

$cabeceras = [];
// $lista;

$cabeceras = $database->switchTabla($tabla);
} else {
    print 'error';
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <!-- <script src="app.js"></script> -->
    <title>Document</title>
</head>

<body>
    
    <form action="update.php" method="POST">
        <?php
        $j = 1;
        $i = 0;
        print '<div id="encabezado">
        <h4>Estas editando la tabla ' . $tabla . ' (ID: '. $id .')</h4>
    </div>';
        $camposNumericos = ['Puntos', 'poles', 'podios', 'titulos', 'victorias', 'Dorsal', 'Numero_de_curvas'];
        print '<div id="cuerpo">';
        print '<input type="hidden" value="' . $tabla . '" name="tabla">';
        foreach ($tablas as $valor) {
            print '<div>';
            if ($cabeceras[$i] != "mostrar") {
                if ($cabeceras[$i] != "id") {
                    if (str_contains($cabeceras[$i], "_id")) {
                        print '<label>' . str_replace("_id", '', $cabeceras[$i]) . '</label>';
                    } else {
                        print '<label>' . $cabeceras[$i] . '</label>';
                    }
                }
                if ($cabeceras[$i] == "id") {

                    print '<input type="hidden" value="' . $tablas[$cabeceras[$i]] . '" placeholder="' . $tablas[$cabeceras[$i]] . '"' . '" name="' . $cabeceras[$i] . '">';
                } else if (in_array($cabeceras[$i], $camposNumericos)) {
                    print '<input type="number" value="' . $tablas[$cabeceras[$i]] . '" class="inputNumero" placeholder="' . $tablas[$cabeceras[$i]] . '"' . '" name="' . $cabeceras[$i] . '">';
                } else if (str_contains($cabeceras[$i], "_id")) {
                    $cabecerasAux[$i] = str_replace("_id", '', $cabeceras[$i]);
                    $cabecerasAux[$i] = strtolower($cabecerasAux[$i]);
                    $lista = $database->getListaForeign($cabecerasAux[$i]);
                    print '<select name= "idAux' . $j . '">';
                    $j++;
                    foreach ($lista as $opcion) {
                        if ($tablas[$cabeceras[$i]] == $opcion['id']) {
                            print '<option value="' . $opcion['id'] . '" selected>';
                            print($opcion['nombre']);
                            print '</option>';
                        } else {
                            print '<option value="' . $opcion['id'] . '">';
                            print($opcion['nombre']);
                            print '</option>';
                        }
                    }
                    print '</select>';
                } else {
                    print '<input type="text" value="' . $tablas[$cabeceras[$i]] . '" class="inputTexto" placeholder="' . $tablas[$cabeceras[$i]] . '" name="' . $cabeceras[$i] . '">';
                }
            }   
            print '</div>';
            $i++;
        }
        print '</div>';
        print '<div id="botones">
            <a href="admin.php?tabla=' . $tabla . '"><button type ="button" id="botonCancelar" >Cancelar</button></a>
                <button type="submit" id="botonConfirmar">Enviar</button>
            </div>';


        ?>
    </form>
</body>
<script src="admin.js"></script>

</html>