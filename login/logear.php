<?php

$accion = $_POST['accion'];

if ($accion == 'login') {

    $campos = [

        $nombre = $_POST['emailL'],
        $pass = $_POST['passL']

    ];

} else {

    $campos = [

    $nombre = $_POST['nombreR'],
    $pass = $_POST['passR']

    ];
}

require_once('../database.php');

$db = new database();

print '<div>' . $accion . '</div>';

if($accion == 'login'){

    $sql = "SELECT * FROM usuarios WHERE nombre = '$nombre' AND contraseña = '$pass';";

    $resultado = $db -> ejecutarSql($sql);

    $pepe = $resultado->fetchAll(PDO::FETCH_ASSOC)[0];

    // Si se encuentra el usuario registrado
    if(isset($pepe['id'])){

        session_start();
        $_SESSION['user'] = $pepe;

        if($pepe['permisos'] == '1'){
            header('Location:../admin/admin.php');
        }else{
            header('Location:../index/index.php');
        }
        
        

        // Si no, se devuelve al login
    }else{
        header('Location:login.html');
    }

}else{

    $sql = "INSERT INTO usuarios (nombre,contraseña,permisos) VALUES ( '$nombre', '$pass',0);";

    var_dump($sql);

    $db -> ejecutarSql($sql);

    $sql = "SELECT * FROM usuarios WHERE nombre = '$nombre' AND contraseña = '$pass';";

    $resultado = $db -> ejecutarSql($sql);

    $pepe = $resultado->fetchAll(PDO::FETCH_ASSOC)[0];

    session_start();
    $_SESSION['user'] = $pepe;

    var_dump($pepe);
    // Al iniciar sesion, se le devuelve al index
    header('Location:../index/index.php');

}