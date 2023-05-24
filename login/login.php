<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body onload="cargarLogin()">
    <nav>
        <ul>
            <img src="../img/logo.jpg">
            <a href="../index/index.php">
                <li>INICIO</li>
            </a>
            <a href="../index/index.php#noticias">
                <li>NOTICIAS</li>
            </a>
            <a href="../index/index.php#clasificacion">
                <li>CLASIFICACIÓN</li>
            </a>
            <a href="../index/index.php#equipos">
                <li>EQUIPOS</li>
            </a>
        </ul>
    </nav>
    <main>

    

            
        <form id="login" action="logear.php" method="POST">
            <h2>Inicio de sesión</h2>
            <input type="text" value="login" name="accion" hidden>
            <div class="peticion">
                <p>Introduce tu nombre:</p>
                <input type="text" class="inputTexto inputLogin" name="emailL" placeholder="Ejemplo: Noobmaster">
            </div>
            <div class="peticion">
                <p>Introduce tu contraseña:</p>
                <input type="password" class="inputPass inputLogin" name="passL" placeholder="*********">
            </div>
            <div class="botones">
                <button type="submit" id="botonConfirmar"><b>Iniciar sesión</b></button>
                <p>¿Aun no tienes un usario? <button type="button" onclick="registrar()"><b>Registrarse</b></button></p>
            </div>
        </form>

        <form id="registro" action="logear.php" method="POST">
            <h2>Registro</h2>
            <input type="text" value="registro" name="accion" hidden>
            <div class="peticion">
                <p>Introduce tu nombre:</p>
                <input type="text" class="inputTexto" name="nombreR" onkeyup="validarString(0, name)"
                    placeholder="Ejemplo: Noobmaster">
            </div>
            <div class="peticion">
                <p>Introduce una contraseña:</p>
                <input type="password" class="inputPass" name="passR" onkeyup="validarPass(3, 'registro', name)"
                    placeholder="qwerty">
            </div>
            <div class="peticion">
                <p id="requisitos">Requistos de la contraseña: Minimo 7 caracteres, minimo 2 digitos, una mayus, un
                    simbolo
                    (. - _ , =)</p>
            </div>
            <div class="peticion">
                <p>Vuelve a introducir la contraseña:</p>
                <input type="password" class="pass2R" name="pass2R" onkeyup="validarRepetirPass(4)"
                    placeholder="Repetir contraseña">
            </div>
            <div class="botones">
                <button type="submit" onclick="esCorrecto()" id="botonConfirmar"> <b>Registrarse</b> </button>
                <p>¿Ya tienes una cuenta? <button type="button" onclick="volverLogin()"> <b>Iniciar sesion</b> </button>
                </p>
            </div>
        </form>
    </main>
    <footer></footer>
</body>
<script src="appLog.js"></script>

</html>