<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $tabla = $_GET['tabla'];

        require_once('../Database.php');

        $database = new Database();
        $database->delete($tabla, $id);
        header('Location: ../admin/admin.php?tabla=' .$tabla);
    } else {
        echo 'Error 404';
    }
?>