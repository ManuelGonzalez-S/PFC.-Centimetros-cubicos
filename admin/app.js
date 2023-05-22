let dialog = document.getElementsByTagName('dialog')[0];

let inputs = document.getElementsByTagName('input');

let botonConfirmar = document.getElementById('botonConfirmar');

cargar();

function cargar(){

    for(let i = 0; i < inputs.length; i++){
        inputs[i].setAttribute('onblur', 'mirarValor(' + i + ')');
    }
}

function mirarValor(i){

    if(inputs[i].value.trim() == ''){

        console.log(inputs[i].value);
        inputs[i].setAttribute('class', 'inputInvalido');
        botonConfirmar.disabled = true;

    }else{

        

    }

}