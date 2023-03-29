let pass, nombre, apellido, email;
let body = document.getElementsByTagName('body')[0];
let admin = document.getElementById('admin');
let main = document.getElementsByTagName('main')[0];
let formularios = document.forms;
let formulario1 = formularios[0];
let formulario2 = formularios[1];
let valMail = /^\w+@[a-zA-Z]+[.][[a-zA-Z]+$/;
let valPass = /(?=.*\d{2})(?=.*[A-Z])+((?=.*[. - _ , =])+).{7,}/;
let valString = /^[a-zA-Z]{3,25}$/;


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


function getDatosLogin() {
    email = formulario1['elements']['emailL']['value'];
    validarMail();
    pass = formulario1['elements']['passL']['value'];
    console.log(email);
    console.log(pass)
}

function hacerRegistro() {
    nombre = formulario2['elements']['nombreR']['value'];
    apellido = formulario2['elements']['apellidoR']['value'];
    email = formulario2['elements']['emailR']['value'];
    pass = formulario2['elements']['passR']['value'];
    pass = formulario2['elements']['pass2R']['value'];

}

function validarString(indice, nombre) {
    if (valString.test(formulario2['elements'][nombre]['value'])) {
        formulario2[indice].classList.remove('incorrecto');
        formulario2[indice].classList.add('correcto');
    } else {
        formulario2[indice].classList.remove('correcto');
        formulario2[indice].classList.add('incorrecto');
    }   
}

function validarMail(indice) {
    if (valMail.test(formulario2['elements']['emailR']['value'])) {
        formulario2[indice].classList.remove('incorrecto');
        formulario2[indice].classList.add('correcto');
    } else {
        formulario2[indice].classList.remove('correcto');
        formulario2[indice].classList.add('incorrecto');
    }
}

function validarPass(indice, n, nombre){
    if (valPass.test(formularios[n]['elements'][nombre]['value'])) {
        formularios[n][indice].classList.remove('incorrecto');
        formularios[n][indice].classList.add('correcto');
    } else {
        formularios[n][indice].classList.remove('correcto');
        formularios[n][indice].classList.add('incorrecto');
    }
    if (indice == 3){
        // validarRepetirPass(indice);
        validarRepetirPass(indice+1);
    }
}

function validarRepetirPass(indice){
    mensaje = document.getElementsByTagName('span')[0];
    if (!(formulario2['elements']['passR']['value'] == formulario2['elements']['pass2R']['value'])){
        mensaje.innerHTML = 'Las contraseñas no coinciden';
        formulario2[indice].classList.remove('correcto');
        formulario2[indice].classList.add('incorrecto');
    } else {
        formulario2[indice].classList.remove('incorrecto');
        formulario2[indice].classList.add('correcto');
        mensaje.innerHTML = ""
    }
    if (indice == 4){
        validarPass(indice);
    }

}

// formulario1[0].classList.add('correcto');