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

if($accion == 'login'){

    $sql = "SELECT * FROM 15_usuarios WHERE nombre = '$nombre' AND contraseña = '$pass';";

    $resultado = $db -> ejecutarSql($sql);

    $pepe = $resultado->fetchAll(PDO::FETCH_ASSOC)[0];

    // Si se encuentra el usuario registrado
    if(isset($pepe['id'])){

        

        session_start();
        $_SESSION['user'] = $pepe;

        if($pepe['permisos'] == '1'){
            header('Location:../admin/admin.php');
        }else{
            header('Location:login.php');
        }
        
        

        // Si no, se devuelve al login
    }else{

        header('Location: login.php?accion=login&error=true');
    }

}else{

    $existe = $db -> ejecutarSql("SELECT * FROM 15_usuarios where nombre='".$nombre."'");

    while ($fila = $existe->fetch(PDO::FETCH_ASSOC)){

        foreach ($fila as $pepe) {
            if(isset($pepe)){
                print $pepe;
                print 'Existe';
                header('Location: login.php?accion=register&error=true');
            }
        }
        exit();
        
    }

    $sql = "INSERT INTO 15_usuarios (nombre,contraseña,permisos) VALUES ( '$nombre', '$pass','0');";

    var_dump($sql);

    $db -> ejecutarSql($sql);

    $sql = "SELECT * FROM 15_usuarios WHERE nombre = '$nombre' AND contraseña = '$pass';";

    $resultado = $db -> ejecutarSql($sql);

    $pepe = $resultado->fetchAll(PDO::FETCH_ASSOC)[0];

    session_start();
    $_SESSION['user'] = $pepe;

    var_dump($pepe);
    // Al iniciar sesion, se le devuelve al index
    header('Location:../index/index.php');

}
