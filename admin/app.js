let dialog = document.getElementsByTagName('dialog')[0];

let inputs = document.getElementsByTagName('input');

let inputsNumeros = document.getElementsByClassName('inputNumero');
let inputsTextos = document.getElementsByClassName('inputTexto');

let botonConfirmar = document.getElementById('botonConfirmar');

cargar();

validarBoton();

function cargar() {

    for (let i = 0; i < inputsNumeros.length; i++) {
        inputsNumeros[i].setAttribute('onkeyup', 'validarInputNumero(' + i + ')');
    }

    for (let i = 0; i < inputsTextos.length; i++) {
        inputsTextos[i].setAttribute('onkeyup', 'validarInputTexto(' + i + ')');
    }
}

function validarBoton(){

    let inputsValidos = document.getElementsByClassName('inputValido');

    if(inputsValidos.length == inputs.length - 1){
        botonConfirmar.setAttribute('id','botonConfirmar');
        botonConfirmar.disabled = false;
    }else{
        botonConfirmar.setAttribute('id','botonInvalido');
        botonConfirmar.disabled = true;
    }

}

let regex = /^\d+$/;

function validarInputNumero(posicion) {

    let input = inputsNumeros[posicion];

    let regex = /^\d+$/;

    let esNumerico = regex.test(input.value);

    if (esNumerico) {
        input.classList.remove("inputInvalido");
        input.classList.add("inputValido");
    } else {
        input.classList.remove("inputValido");
        input.classList.add("inputInvalido");
    }

    validarBoton();
}

function validarInputTexto(posicion) {

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