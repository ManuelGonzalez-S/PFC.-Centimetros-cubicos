let body = document.getElementsByTagName('body')[0];
let main = document.getElementsByTagName('main')[0];
let formularios = document.forms;
let formulario1 = formularios[0];
let formulario2 = formularios[1];

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
let usuarioExistente = false;

function registrar() {
    main.appendChild(formulario2);
    main.removeChild(formulario1);

    validarBoton();
}

function volverLogin() {
    main.appendChild(formulario1);
    main.removeChild(formulario2);

    validarBoton();
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

const botonConfirmar = document.getElementsByClassName('botonconfirmar');

function validarBoton(){

    let inputsValidos = document.getElementsByClassName('inputValido');

    let inputs = document.getElementsByTagName('input');

    for (boton in botonConfirmar) {

        if(inputsValidos.length == inputs.length){
            boton.setAttribute('class','botonValido');
            boton.disabled = false;
        }else{
            boton.setAttribute('class','botonInvalido');
            boton.disabled = true;
        }

    }

}

let inputsLogin = document.getElementsByClassName('inputLogin');

for (let i = 0; i < inputsLogin.length; i++) {
    inputsLogin[i].setAttribute('onkeyup', 'validarInputTexto(' + i + ')');
}

function validarInputLogin(posicion) {

    let input = inputsTextos[posicion];

    let valor = input.value.trim();
    let contieneNumeros = /[0-9]/.test(valor); // Verifica si el valor contiene números
    let letras = valor.match(/[a-zA-Z]/g); // Busca todas las letras en el valor

    if (!contieneNumeros && letras && letras.length >= 4) {
        input.classList.remove("inputInvalido");
        input.classList.add("inputValido");
    } else {
        input.classList.remove("inputValido");
        input.classList.add("inputInvalido");
    }

    validarBoton();
}