let body = document.getElementsByTagName('body')[0];
let admin = document.getElementById('admin');
let main = document.getElementsByTagName('main')[0];
let formularios = document.forms;
let formulario1 = formularios[0];
let formulario2 = formularios[1];
let valMail = /^\w+@[a-zA-Z]+[.][[a-zA-Z]+$/;
let valPass = /(?=.*\d{2})(?=.*[A-Z])+((?=.*[. - _ , =])+).{7,}/;
let valString = /^[a-zA-Z]{3,25}$/;
let correcto = false;
let nombreVal = false;
let apellidoVal = false;
let emailVal = false;
let passVal = false;
let pass2Val = false;
mensaje = document.getElementsByTagName('span')[1];
mensajeLog = document.getElementsByTagName('span')[0];
let usuariosRegistrados = [
    ['admin', 'admin', 'admin@admin.com', 'admin']
];
let usuarioExistente = false;

function registrar() {
    main.removeChild(admin);
    main.appendChild(formulario2);
    main.removeChild(formulario1);
    main.appendChild(admin);
}

function volverLogin() {
    main.removeChild(admin);
    main.appendChild(formulario1);
    main.removeChild(formulario2);
    main.appendChild(admin);

}

function cargarLogin() {
    main.removeChild(formulario2);
}

function validarString(indice, nombre) {
    nombreR = formulario2['elements'][nombre]['value']
    if (valString.test(nombreR)) {
        formulario2[indice].classList.remove('incorrecto');
        formulario2[indice].classList.add('correcto');
        if (indice == 0) {
            nombreVal = true;
        } else {
            apellidoVal = true;
        }
    } else {
        formulario2[indice].classList.remove('correcto');
        formulario2[indice].classList.add('incorrecto');
        if (indice == 0) {
            nombreVal = false;
        } else {
            apellidoVal = false;
        }
    }
}

function validarMail(indice) {
    emailR = formulario2['elements']['emailR']['value']
    if (valMail.test(emailR)) {
        formulario2[indice].classList.remove('incorrecto');
        formulario2[indice].classList.add('correcto');
        emailVal = true;
    } else {
        formulario2[indice].classList.remove('correcto');
        formulario2[indice].classList.add('incorrecto');
        emailVal = false;
    }
}

function validarPass(indice, n, nombre) {
    if (valPass.test(formularios[n]['elements'][nombre]['value'])) {
        formularios[n][indice].classList.remove('incorrecto');
        formularios[n][indice].classList.add('correcto');
        mensaje.innerHTML = ""
        passVal = true;
    } else {
        formularios[n][indice].classList.remove('correcto');
        formularios[n][indice].classList.add('incorrecto');
        passVal = false;
    }
    if (formulario2['elements']['passR']['value'] != formulario2['elements']['pass2R']['value']) {
        formularios[n][indice + 1].classList.remove('correcto');
        formularios[n][indice + 1].classList.add('incorrecto');
        mensaje.classList.remove('bien');
        mensaje.classList.add('mal');
        mensaje.innerHTML = 'Las contraseñas no coinciden';
        pass2Val = false;
    } else {
        formulario2[indice + 1].classList.remove('incorrecto');
        formulario2[indice + 1].classList.add('correcto');
        mensaje.classList.add('bien');
        mensaje.classList.remove('mal');
        mensaje.innerHTML = "";
        pass2Val = true;
    }
}

function validarRepetirPass(indice) {

    if (!(formulario2['elements']['passR']['value'] == formulario2['elements']['pass2R']['value'])) {
        formulario2[indice].classList.remove('correcto');
        formulario2[indice].classList.add('incorrecto');
        mensaje.classList.remove('bien');
        mensaje.classList.add('mal');
        mensaje.innerHTML = 'Las contraseñas no coinciden';
        pass2Val = false;
    } else {
        formulario2[indice].classList.remove('incorrecto');
        formulario2[indice].classList.add('correcto');
        mensaje.classList.add('bien');
        mensaje.classList.remove('mal');
        mensaje.innerHTML = ""
        pass2Val = true;
    }
}

function esCorrecto() {
    if (nombreVal && apellidoVal && emailVal && passVal && pass2Val) {
        nom = formulario2['elements']['nombreR']['value'];
        ape = formulario2['elements']['apellidoR']['value'];
        user = formulario2['elements']['emailR']['value'];
        pas = formulario2['elements']['passR']['value'];
        correcto = true;
        usuariosRegistrados.push([nom, ape, user, pas]);
        console.log(usuariosRegistrados);
        mensaje.classList.remove('mal');
        mensaje.classList.add('bien');
        mensaje.innerHTML = "Registro exitoso";
    } else {
        correcto = false;
    }
}

function verificarMail() {
    let n = 0;
    emailL = formularios[0]['elements']['emailL']['value'];
    passL = formularios[0]['elements']['passL']['value'];
    do {
        if (emailL == usuariosRegistrados[n][2]) {
            usuarioExistente = true;
        }
        console.log(usuarioExistente);
        n++;
    } while (n < usuariosRegistrados.length && !usuarioExistente);
    if (usuarioExistente) {
        mensajeLog.innerHTML = 'Mail encontrado'
    } else {
        mensajeLog.innerHTML = 'Mail no encontrado'
    }
}
