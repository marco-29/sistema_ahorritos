const contrasenhaInput = document.getElementById('contrasenha');
const validarContrasenhaInput = document.getElementById('validar_contrasenha');
const mensajeElement = document.getElementById('validar_contrasenha_mensaje');
const mostrarContrasenhaBtn = document.getElementById('mostrar_contrasenha_btn');
const mostrarValidarContrasenhaBtn = document.getElementById('mostrar_validar_contrasenha_btn');

// Agregamos un evento 'input' a validarContrasenhaInput para verificar la coincidencia y la longitud de la contrasenha en tiempo real
validarContrasenhaInput.addEventListener('input', function () {
    const contrasenha = contrasenhaInput.value;
    const validarContrasenha = validarContrasenhaInput.value;

    if (contrasenha.length < 8) {
        mensajeElement.innerText = 'La contraseña debe tener al menos 8 caracteres.';
        mensajeElement.style.color = 'red';
    } else if (contrasenha === validarContrasenha) {
        mensajeElement.innerText = 'Las contraseñas coinciden.';
        mensajeElement.style.color = 'green';
    } else {
        mensajeElement.innerText = 'Las contraseñas no coinciden.';
        mensajeElement.style.color = 'red';
    }
});

mostrarContrasenhaBtn.addEventListener('click', function () {
    mostrarOcultarContrasenha(contrasenhaInput, mostrarContrasenhaBtn);
});

mostrarValidarContrasenhaBtn.addEventListener('click', function () {
    mostrarOcultarContrasenha(validarContrasenhaInput, mostrarValidarContrasenhaBtn);
});

function mostrarOcultarContrasenha(input, btn) {
    if (input.type === 'password') {
        input.type = 'text';
        btn.innerHTML = '<i class="fa fa-eye-slash"></i>'; // Icono de ojo tachado
    } else {
        input.type = 'password';
        btn.innerHTML = '<i class="fa fa-eye"></i>'; // Icono de ojo abierto
    }
}

$(document).ready(function () {
	document.getElementById('nota').onload = function () {
		document.getElementById('nota-count').innerHTML = (this.value.length) + '/500';
	};

	document.getElementById('nota').onkeyup = function () {
		document.getElementById('nota-count').innerHTML = (this.value.length) + '/500';
	};

	$(".select2-amenidades").select2({
		placeholder: "Amenidades",
	});
});