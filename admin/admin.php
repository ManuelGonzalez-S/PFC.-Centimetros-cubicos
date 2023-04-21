<?php
require_once('../database.php');
$database = new Database();
$cabeceras = [];
$tablas = ["equipos", "pilotos", "coches", "patrocinadores", "circuitos"];

if (isset($_GET['tabla'])) {
    $aux = $_GET['tabla'];
    if (!in_array($aux, $tablas)){
        print '<h1>La tabla no existe</h1>';
        $aux = null;
    } 
}
function imprimirTabla($nombreTabla)
{
    ;
    $database = new Database();
    $resultados = $database->getTabla($nombreTabla);
    print '<table>
    <thead>
         <tr>';
    switch ($nombreTabla) {
        case "equipos":
            $cabeceras = ["Acciones", "id", "Puntos", "nombre", "poles", "podios", "titulos", "victorias"];
            break;
        case "pilotos":
            $cabeceras = ["Acciones", "id", "Nombre", "Puntos", "Dorsal", "nacionalidad", "Equipos_id"];
            break;
        case "coches":
            $cabeceras = ["Acciones", "id", "nombre", "Modelo", "Motor", "Pilotos_id", "Equipos_id"];
            break;
        case "circuitos":
            $cabeceras = ["Acciones", "id", "Nombre", "Longitud", "Numero_de_curvas", "Temporada_id"];
            break;
        case "patrocinadores":
            $cabeceras = ["Acciones", "id", "Nombre", "Equipos_id"];
            break;
    }
    ;
    foreach ($cabeceras as $campo) {
        print '<th>' . $campo . '</th>';
    }
    ;
    print '</tr>
    </thead>
    <tbody>';

    foreach ($resultados as $row) {
        print '<tr><td>
        <a><button>update</button></a>
        <a href="delete.php?id=' . $row['id'] . '"><button>delete</button></a>
        </td>';
        for ($i = 1; $i < sizeof($cabeceras); $i++) {
            print '<td>' . $row[$cabeceras[$i]] . '</td>';
        }
        print '</tr>';
    }
    print '</tbody>
</table>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Document</title>
</head>

<body>
    <nav>
        <ul>
            <li>
                <a href="../index/index.php" id="volver">
                    <button> <img src="../img/hacia-atras.png"> VOLVER</button>
                </a>
            </li>
        </ul>
    </nav>
    <main>
        <section class="acciones">
            <p>Seleccionar la tabla para modificarla</p>
            <div class="entidades">
                <?php
                    foreach ($tablas as $tabla){
                        print '<a href="?tabla=' . $tabla . '"><button class="entidad">' . $tabla .'</button></a>';
                    }
                ?>
            </div>
        </section>
        <section class="tablaDatos">
            <p>TABLA DE DATOS</p>
            <?php
            if (!isset($aux)){
                print '<h1>SELECCIONA UNA TABLA PARA MOSTRAR SUS DATOS</h1>';

            } else {
            imprimirTabla($aux);
            }
            ?>

        </section>

    </main>
</body>

</html>