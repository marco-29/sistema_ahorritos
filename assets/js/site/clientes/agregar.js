document.addEventListener("DOMContentLoaded", function () {
	$(".select2").select2();
	$(".select2-amenidades").select2({
		placeholder: "Amenidades",
	});

	const notaInput = document.getElementById("nota");
	const notaCount = document.getElementById("nota-count");

	if (notaInput && notaCount) {
		const updateNotaCount = () => {
			notaCount.textContent = `${notaInput.value.length}/240`;
		};
		updateNotaCount();
		notaInput.addEventListener("keyup", updateNotaCount);
	}

	const nombreField = document.getElementById("nombre");
	const apellidoPaternoField = document.getElementById("apellido_paterno");
	const apellidoMaternoField = document.getElementById("apellido_materno");
	const telefonoField = document.getElementById("telefono");
	const correoField = document.getElementById("correo_electronico");

	// Elementos de mensajes en el HTML
	const mensajeChecklist = document.getElementById("mensaje_checklist");
	const mensajeNombre = document.getElementById("mensaje_comprobacion_nombre");
	const mensajeCelular = document.getElementById(
		"mensaje_comprobacion_no_celular"
	);
	const mensajeCorreo = document.getElementById("mensaje_comprobacion_correo");

	// Función para verificar si el cliente ya existe
	function verificarCliente(campo, valor, mensajeElemento, mensajeTexto) {
		fetch("verificar_existencia", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
			},
			body: JSON.stringify({ campo: campo, valor: valor }),
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.existe) {
					mensajeElemento.innerHTML = `
				  <i class="ft-alert-circle red"></i> 
				  ${mensajeTexto} ya está registrado por el asesor: ${data.asesor}.
				`;
				} else {
					mensajeElemento.innerHTML = `<i class="ft-alert-circle green"></i> ${mensajeTexto} esta disponible`;
				}
			})
			.catch((error) => console.error("Error:", error));
	}

	// Función de debounce para reducir las llamadas a la verificación
	function debounce(func, delay) {
		let timeout;
		return function (...args) {
			clearTimeout(timeout);
			timeout = setTimeout(() => func.apply(this, args), delay);
		};
	}

	// Verificación del nombre completo con debounce
	// const verificarNombreCompleto = debounce(() => {
	// 	const nombreCompleto = `${nombreField.value.trim()} ${apellidoPaternoField.value.trim()} ${apellidoMaternoField.value ? apellidoMaternoField.value.trim() : ''}`.trim();
	// 	if (nombreCompleto) {
	// 		verificarCliente("nombre_completo", nombreCompleto, mensajeNombre, "Por favor registre el nombre completo");
	// 	}
	// }, 500);

	const verificarNombreCompleto = debounce(() => {
		// Validar que todos los campos requeridos existan y no estén vacíos
		const nombre = nombreField.value.trim();
		const apellidoPaterno = apellidoPaternoField.value.trim();
		const apellidoMaterno = apellidoMaternoField.value
			? apellidoMaternoField.value.trim()
			: "";

		if (nombre && apellidoPaterno) {
			const nombreCompleto =
				`${nombre} ${apellidoPaterno} ${apellidoMaterno}`.trim();
			console.log("Nombre completo a verificar:", nombreCompleto);
			verificarCliente(
				"nombre_completo",
				nombreCompleto,
				mensajeNombre,
				"El nombre completo"
			);
		} else {
			mensajeNombre.innerHTML =
				"<i class='ft-alert-circle red'></i> Por favor registre el nombre completo.";
		}
	}, 500);

	// Verificación de teléfono y correo con debounce
	const verificarTelefono = debounce(
		() =>
			verificarCliente(
				"telefono",
				telefonoField.value,
				mensajeCelular,
				"El número celular"
			),
		500
	);
	const verificarCorreo = debounce(
		() =>
			verificarCliente(
				"correo_electronico",
				correoField.value,
				mensajeCorreo,
				"El correo electrónico"
			),
		500
	);

	// Eventos para verificar el cliente en cada campo
	[nombreField, apellidoPaternoField, apellidoMaternoField].forEach((field) => {
		field.addEventListener("blur", verificarNombreCompleto);
		field.addEventListener("keyup", verificarNombreCompleto);
		field.addEventListener("change", verificarNombreCompleto);
	});

	telefonoField.addEventListener("blur", verificarTelefono);
	telefonoField.addEventListener("keyup", verificarTelefono);
	telefonoField.addEventListener("change", verificarTelefono);

	correoField.addEventListener("blur", verificarCorreo);
	correoField.addEventListener("keyup", verificarCorreo);
	correoField.addEventListener("change", verificarCorreo);

	// // Mostrar el mensaje de checklist general
	// mensajeChecklist.innerHTML = "<i class='ft-alert-circle green'></i> Check list de requisitos de cliente [Completa todos los pasos].";
});
