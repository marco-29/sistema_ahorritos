// index.js

const metodo_llamada = document.URL.includes("index") ? "" : "clientes/";

$.fn.dataTable.ext.errMode = 'throw'; // Configuración de manejo de errores de DataTables
$.fn.dataTable.ext.type.order['time-pre'] = function (d) {
    return moment(d, 'hh:mm A').format('HHmm');
};

document.addEventListener('DOMContentLoaded', function () {
    const tabla = $('#table').DataTable({
        searching: true,
        scrollX: true,
        scrollY: '700px',
        deferRender: true,
        processing: true,
        serverSide: true,
        order: [[1, "desc"]],
        lengthMenu: [[25, 50, 100, 250, 500, 1000, 2500, 5000], [25, 50, 100, 250, 500, 1000, 2500, 5000]],
        ajax: {
            url: `${metodo_llamada}obtener_tabla_index`,
            type: 'POST',
            data: function (d) {
                d.filtro_estatus_cliente = $('#filtro_estatus_cliente').val();
                d.filtro_desarrollo_interes = $('#filtro_desarrollo_interes').val();
                d.filtro_como_se_entero = $('#filtro_como_se_entero').val();
                d.filtro_asesor = $('#filtro_asesor').val();
                d.filtro_interes_semanal = $('#filtro_interes_semanal').val();
                d.filtro_medio_contacto = $('#filtro_medio_contacto').val();
            }
        },
        columns: [
            { data: "opciones", orderable: false },
            { data: "id" },
            { data: "nombre" },
            { data: "desarrollo_interes_identificador" },
            { data: "estatus_cliente" },
            { data: "nivel_interes" },
            { data: "como_se_entero" },
            { data: "metodo_contacto" },
            { data: "correo_electronico" },
            { data: "telefono" },
            { data: "ultima_nota" },
            { data: "persona_fiscal" },
            { data: "nombre_representante_legal" },
            { data: "domicilio_fiscal" },
            { data: "fecha_nacimiento" },
            { data: "estado_civil" },
            { data: "curp" },
            { data: "ine" },
            { data: "rfc" },
            { data: "identificador" },
            { data: "asesor" },
            { data: "fecha_registro" },
            { data: "fecha_actualizacion" }
        ],
        rowCallback: function (fila, datos, indice) {
            aplicar_estilo_estatus_cliente($(fila).find('td:eq(4)'), datos["estatus_cliente"]);
            aplicar_estilo_nivel_interes($(fila).find('td:eq(5)'), datos["nivel_interes"]);
        },
        language: {
            sProcessing: '<i class="fa fa-spinner spinner"></i> Cargando...',
            sLengthMenu: "Mostrar _MENU_",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo: "Mostrando del _START_ al _END_ de _TOTAL_",
            sInfoEmpty: "Mostrando del 0 al 0 de 0",
            sInfoFiltered: "(filtrado de _MAX_)",
            sSearch: "Buscar:",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: ">",
                sPrevious: "<"
            }
        }
    });

    // Función debounce para evitar llamadas excesivas al servidor al cambiar filtros
    const debounce = (funcion, retardo) => {
        let temporizador_debounce;
        return function () {
            const contexto = this;
            const args = arguments;
            clearTimeout(temporizador_debounce);
            temporizador_debounce = setTimeout(() => funcion.apply(contexto, args), retardo);
        };
    };

    // Eventos para actualizar la tabla según los filtros con debounce
    $('#filtro_estatus_cliente, #filtro_desarrollo_interes, #filtro_como_se_entero, #filtro_asesor, #filtro_interes_semanal, #filtro_medio_contacto').change(debounce(function () {
        tabla.draw();
    }, 300));

    const botones = new $.fn.dataTable.Buttons(tabla, {
        buttons: [
            {
                extend: 'excelHtml5',
                className: 'custom-button'
            }
        ]
    }).container().appendTo($('#buttons'));

    $('.select2').select2();
});

// Función para aplicar estilos al estatus del cliente
function aplicar_estilo_estatus_cliente($celda, estatus_cliente) {
    let color_fondo = '';
    let color_texto = '';
    switch (estatus_cliente) {
        case "Comprador": color_fondo = '#1E9FF2'; color_texto = 'white'; break;
        case "Copropietario": color_fondo = '#BCE2FB'; color_texto = 'white'; break;
        case "Inquilino": color_fondo = '#BFF1DF'; color_texto = 'white'; break;
        case "Socio": color_fondo = '#F6BB42'; color_texto = 'white'; break;
        case "Prospecto": color_fondo = '#28D094'; color_texto = 'white'; break;
        case "Vendedor": color_fondo = '#7242f6'; color_texto = 'white'; break;
        case "Descartar": color_fondo = '#FFCC80'; color_texto = 'black'; break;
        case "Descartado": color_fondo = '#F44336'; color_texto = 'white'; break;
        default: color_fondo = ''; color_texto = ''; break;
    }
    $celda.css('background-color', color_fondo).css('color', color_texto);
}

function aplicar_estilo_nivel_interes($celda, nivel_interes) {
    let color_fondo = '';
    let color_texto = '';
    switch (nivel_interes) {
        case "Alto": color_fondo = '#28a745'; color_texto = 'white';
            break;
        case "Medio": color_fondo = '#ffc107'; color_texto = 'black';
            break;
        case "Bajo": color_fondo = '#dc3545'; color_texto = 'white';
            break;
        case "Nulo": color_fondo = '#6c757d'; color_texto = 'white';
            break;
        default: color_fondo = ''; color_texto = '';
            break;
    }
    $celda.css('background-color', color_fondo).css('color', color_texto);
}


// Función para manejar eventos de actualización
async function manejo_evento(clase_id, accion, funcion, comentario) {
    const boton = document.querySelector(`#${accion}_${clase_id}`);
    if (!boton) {
        console.error(`Botón con ID #${accion}_${clase_id} no encontrado`);
        return;
    }
    const mensaje_en_pantalla = document.querySelector('#mensaje_en_pantalla');

    if (boton.dataset.clicked) {
        return;
    }

    bloquear_boton(boton, 'Procesando...');

    mostrar_mensaje('info', 'Procesando...', mensaje_en_pantalla);

    try {
        const datos = await obtener_datos(`${metodo_llamada}${funcion}/${clase_id}`, { clase_id, comentario });

        if (datos.success) {
            mostrar_mensaje('success', datos.message, mensaje_en_pantalla);

            const datos_actualizados = datos.data;
            const fila = $('#table').DataTable().row(boton.closest('tr'));

            if (fila) {
                // Actualizar los datos de la fila
                // fila.data(datos_actualizados).draw(false);
                fila.data(datos_actualizados) // Se elimino el draw para no actualizar la tabla despues de alguna modificación

                // Vuelve a aplicar el estilo a la celda de estatus_cliente
                const $celda_estatus = $(fila.node()).find('td:eq(4)');
                aplicar_estilo_estatus_cliente($celda_estatus, datos_actualizados.estatus_cliente);

                // Vuelve a aplicar el estilo a la celda de nivel_interes
                const $celda_nivel_interes = $(fila.node()).find('td:eq(5)');
                aplicar_estilo_nivel_interes($celda_nivel_interes, datos_actualizados.nivel_interes);
            } else {
                console.error('Fila no encontrada para actualizar.');
            }

        } else {
            mostrar_mensaje('error', datos.message, mensaje_en_pantalla);
            desbloquear_boton(boton, capitalizar_primera_letra(accion));
        }

    } catch (error) {
        console.error('Error:', error);
        mostrar_mensaje('error', 'No se pudo procesar la solicitud.', mensaje_en_pantalla);
        desbloquear_boton(boton, capitalizar_primera_letra(accion));
    }
}

// Funciones auxiliares
function bloquear_boton(boton, mensaje) {
    boton.dataset.clicked = true;
    boton.disabled = true;
    boton.innerHTML = `<i class="fa fa-spinner spinner"></i> ${mensaje}`;
    boton.classList.add('text-warning');
}

function desbloquear_boton(boton, texto_original) {
    boton.disabled = false;
    boton.innerHTML = texto_original;
    boton.classList.remove('text-warning');
    delete boton.dataset.clicked;
}

function mostrar_mensaje(tipo, mensaje, elemento) {
    // tipos: 'success', 'info', 'warning', 'error'
    const clases = {
        success: 'text-success',
        info: 'text-info',
        warning: 'text-warning',
        error: 'text-danger'
    };
    elemento.innerHTML = mensaje;
    elemento.className = clases[tipo] || 'text-info';
}

function capitalizar_primera_letra(cadena) {
    return cadena.charAt(0).toUpperCase() + cadena.slice(1);
}

async function obtener_datos(url, datos) {
    const respuesta = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datos)
    });
    if (!respuesta.ok) {
        throw new Error(`Error ${respuesta.status}: ${respuesta.statusText}`);
    }
    return await respuesta.json();
}

// Funciones para manejar acciones específicas
function comprador(clase_id) {
    manejar_estatus(clase_id, 'comprador', 'comprador');
}

function prospecto(clase_id) {
    manejar_estatus(clase_id, 'prospecto', 'prospecto');
}

function descartar(clase_id) {
    manejar_estatus(clase_id, 'descartar', 'descartar');
}

function descartado(clase_id) {
    manejar_estatus(clase_id, 'descartado', 'descartado');
}

function comentario(clase_id) {
    manejar_estatus(clase_id, 'comentario', 'comentario');
}

function interes_alto(clase_id) {
    manejar_estatus(clase_id, 'alto', 'interes_alto');
}

function interes_medio(clase_id) {
    manejar_estatus(clase_id, 'medio', 'interes_medio');
}

function interes_bajo(clase_id) {
    manejar_estatus(clase_id, 'bajo', 'interes_bajo');
}

function interes_nulo(clase_id) {
    manejar_estatus(clase_id, 'nulo', 'interes_nulo');
}

// Función para manejar el estatus y mostrar el modal
async function manejar_estatus(clase_id, boton, funcion) {
    try {
        const datos = await obtener_datos(`${metodo_llamada}obtener_info_cliente/${clase_id}`, { clase_id });

        const titulo_accion = boton !== 'comentario' ? `Actualizar a ${boton}` : 'Agregar comentario';

        if (datos.success) {
            $('#tituloModal').html(`<h4><b>${titulo_accion}</b></h4><br>`);

            const campos_cliente = [
                { etiqueta: 'Nombre', valor: datos.data.nombre },
                { etiqueta: 'Desarrollo de interés', valor: datos.data.desarrollo_interes_identificador },
                { etiqueta: 'Estatus', valor: datos.data.estatus_cliente },
                { etiqueta: 'Nivel de interés', valor: datos.data.nivel_interes },
                { etiqueta: '¿Cómo se enteró?', valor: datos.data.como_se_entero },
                { etiqueta: 'Método de contacto', valor: datos.data.metodo_contacto },
                { etiqueta: 'Correo electrónico', valor: datos.data.correo_electronico },
                { etiqueta: 'Teléfono', valor: datos.data.telefono },
                { etiqueta: 'Última nota', valor: datos.data.ultima_nota },
                { etiqueta: 'Persona fiscal', valor: datos.data.persona_fiscal },
                { etiqueta: 'Nombre del representante legal', valor: datos.data.nombre_representante_legal },
                { etiqueta: 'Domicilio fiscal', valor: datos.data.domicilio_fiscal },
                { etiqueta: 'Fecha de nacimiento', valor: datos.data.fecha_nacimiento },
                { etiqueta: 'Estado civil', valor: datos.data.estado_civil },
                { etiqueta: 'CURP', valor: datos.data.curp },
                { etiqueta: 'INE', valor: datos.data.ine },
                { etiqueta: 'RFC', valor: datos.data.rfc },
                { etiqueta: 'Identificador', valor: datos.data.identificador },
                { etiqueta: 'Asesor', valor: datos.data.asesor },
                { etiqueta: 'Fecha de registro', valor: datos.data.fecha_registro },
                { etiqueta: 'Fecha de actualización', valor: datos.data.fecha_actualizacion }
            ];

            let info_cliente_titulo_html = '';
            let info_cliente_html = '';

            campos_cliente.forEach(campo => {
                info_cliente_titulo_html += `<p><strong>${campo.etiqueta}:</strong></p>`;
                info_cliente_html += `<p>${escapar_html(campo.valor) || '-'}</p>`;
            });

            $('#infoClienteTitulo').html(info_cliente_titulo_html);
            $('#infoCliente').html(info_cliente_html);

            // Construir HTML para las notas
            let notas_html = '';
            if (datos.data.notas_list && datos.data.notas_list.length > 0) {
                datos.data.notas_list.forEach((nota, indice) => {
                    let fecha_nota = new Date(nota.fecha_registro);
                    notas_html += `
                        <div class="list-group-item flex-column align-items-start ${indice === 0 ? 'active' : ''}">
                            <div class="d-flex w-100 justify-content-between">
                                <small>${fecha_nota.toLocaleString('es-ES')}</small>
                            </div>
                            <p>${escapar_html(nota.nota)}</p>
                            <small>${escapar_html(nota.usuarios_correo_electronico)}</small>
                        </div>
                    `;
                });
            } else {
                notas_html = '<p>No hay notas disponibles.</p>';
            }

            $('#notas').html(notas_html);

            $('#comentarioModal').modal('show');

            // Asignar evento al botón para guardar el comentario
            $('#guardarComentario').off('click').on('click', async function () {
                const comentario = $('#comentario').val().trim();

                if (comentario === "") {
                    alert('Por favor, ingresa un comentario.');
                    return;
                }

                $('#comentarioModal').modal('hide');
                $('#comentario').val('');

                await manejo_evento(clase_id, boton, funcion, comentario);
            });

        } else {
            console.error('Error al obtener datos:', datos.message);
            alert('No se pudo obtener la información. Intenta de nuevo.');
        }

    } catch (error) {
        console.error('Error:', error);
        alert('Ocurrió un error al procesar la solicitud.');
    }
}

// Función para escapar caracteres especiales y prevenir XSS
function escapar_html(texto) {
    if (!texto) return '';
    const mapa = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return texto.toString().replace(/[&<>"']/g, function (m) { return mapa[m]; });
}
