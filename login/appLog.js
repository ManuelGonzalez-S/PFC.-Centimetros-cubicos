let body = document.getElementsByTagName('body')[0];
let main = document.getElementsByTagName('main')[0];
let formularios = document.forms;
let formulario1 = formularios[0];
let inputsL = formulario1.getElementsByTagName('input');
let formulario2 = formularios[1];
let inputsR = formulario2.getElementsByTagName('input');
let inputpassR = document.getElementsByClassName('inputPass')[0];
let inputpassL = inputsR.getElementsByClassName('inputPass')[0];
let inputTextoL = inputsL.getElementsByClassName('inputTexto')[0];
let inputTextoR = inputsR.getElementsByClassName('inputTexto')[0];
let valPass = /(?=.*\d{2})(?=.*[A-Z])+((?=.*[. - _ , =])+).{7,}/;
let valString = /^[a-zA-Z]{3,25}$/;



let correcto = false;
let nombreVal = false;
let passVal = false;
let pass2Val = false;
// let usuarioExistente = false;

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

// for (let i = 0; i < inputsLogin.length; i++) {
//     inputsLogin[i].setAttribute('onkeyup', 'validarInputTexto(' + i + ')');
// }

inputTextoL.setAttribute('onkeyup', 'validarTexto(0)');
console.log(inputTextoL);
inputPassL.setAttribute('onkeyup', 'validarPass(1)');

inputTextoR.setAttribute('onkeyup', 'validarTexto(2)');
inputPassR.setAttribute('onkeyup', 'validarPass(3)');

function validarTexto(posicion) {

    let input = inputsLogin[posicion]

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