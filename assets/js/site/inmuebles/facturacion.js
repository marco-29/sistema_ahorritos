// Variables
var table;
var actual_url = document.URL;
var method_call = "";
var identificador = window.location.pathname.split('/').pop();
var url;
var flag_editando = false;
var select_estatus_pago = [];
var select_estatus_factura = [];

// Configuraciones
(actual_url.indexOf("index") < 0) ? method_call = "../" : method_call = "";
$.fn.dataTable.ext.errMode = 'throw'; // Configuración de manejo de errores de DataTables

$(document).ready(function () {
    // Inicializar
    url = method_call + "obtener_tabla_ver_facturacion/" + identificador
    // obtener_saldos_del_mes(identificador)
    obtener_opciones_select_estatus_pago(); // Obtención de opciones para el select 'estatus_pago'
    obtener_opciones_select_estatus_factura(); // Obtención de opciones para el select 'estatus_pago'

    table = $('#table').DataTable({
        "scrollX": true,
        "deferRender": true,
        'processing': true,
        "order": [[2, "asc"]],
        "lengthMenu": [[25, 50, 100, 250, 500, -1], [25, 50, 100, 250, 500, "Todos"]],
        "ajax": {
            "url": url,
            "type": 'POST'
        },
        "columns": [
            { "data": "id" },
            { "data": "identificador" },
            { "data": "desarrollo" },
            { "data": "nombre_inmueble" },
            { "data": "pago_identificador" },
            { "data": "concepto" },
            { "data": "cliente_nombre" },
            { "data": "rfc" },
            { "data": "codigo_postal" },
            { "data": "regimen_fiscal" },
            { "data": "uso_cfdi" },
            { "data": "monto", "render": formato_moneda },
            { "data": "archivos" },
            { "data": "estatus_factura" },
            { "data": "fecha_registro" },
            { "data": "fecha_actualizacion" },
            { "data": "opciones" },
        ],
        "createdRow": createEditableCells,
        rowCallback: function (row, data, index) {
            console.log(data["estatus_factura"]);
            if (data["estatus_factura"] == "Solicitud de factura") {
                $(row).find('td:eq(13)').css('background-color', '#1E9FF2');
                $(row).find('td:eq(13)').css('color', 'white');
            } else if (data["estatus_factura"] == "Solicitud de complemento de pago") {
                $(row).find('td:eq(13)').css('background-color', '#BCE2FB');
                $(row).find('td:eq(13)').css('color', 'white');
            } else if (data["estatus_factura"] == "Facturado") {
                $(row).find('td:eq(13)').css('background-color', '#28D094');
                $(row).find('td:eq(13)').css('color', 'white');
            } else if (data["estatus_factura"] == "Facturado complemento") {
                $(row).find('td:eq(13)').css('background-color', '#BFF1DF');
                $(row).find('td:eq(13)').css('color', 'white');
            }
        },
        'language': {
            "sProcessing": '<i class="fa fa-spinner spinner"></i> Cargando...',
            "sLengthMenu": "Mostrar _MENU_",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla =(",
            "sInfo": "Mostrando del _START_ al _END_ de _TOTAL_",
            "sInfoEmpty": "Mostrando del 0 al 0 de 0",
            "sInfoFiltered": "(filtrado _MAX_)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "&nbsp;",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": ">",
                "sPrevious": "<"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }

    });

    // Creación de botón de exportación a Excel
    var buttons = new $.fn.dataTable.Buttons(table, {
        buttons: [
            'excelHtml5',
        ]
    }).container().appendTo($('#buttons'));

    // Detectar doble clic en celda editable
    $('#table').on('dblclick', 'td.editable-cell', function () {
        if (!flag_editando) {

            flag_editando = true; // Marcar como en edición

            var celda_seleccionada = $(this); // Obtener la celda seleccionada
            var columna_indice = celda_seleccionada.index(); // Obtener el nombre de la columna según el índice
            var columna_nombres_list = table.settings().init().columns;
            console.log(columna_nombres_list);
            var columna_nombre = columna_nombres_list[columna_indice].data;
            var valor_original_de_celda = celda_seleccionada.text();

            if (columna_nombre === "monto") {
                var input = generar_campo_de_celda_a_editar('numero', valor_original_de_celda, null)
            } else if (columna_nombre === "regimen_fiscal") {
                var input = generar_campo_de_celda_a_editar('select', valor_original_de_celda, select_regimen_fiscal, select_regimen_fiscal_moral);
            } else if (columna_nombre === "uso_cfdi") {
                var input = generar_campo_de_celda_a_editar('select', valor_original_de_celda, select_uso_cfdi, select_uso_cfdi_moral);
            } else if (columna_nombre === "estatus_factura") {
                var input = generar_campo_de_celda_a_editar('select', valor_original_de_celda, select_estatus_factura);
            } else {
                var input = generar_campo_de_celda_a_editar('texto', valor_original_de_celda, null);
            }

            celda_seleccionada.data('valor_original_guardado', valor_original_de_celda); // Almacena el valor original en la celda
            celda_seleccionada.html(input);

            input.focus();

            // Guardar los cambios al salir del campo de entrada
            input.blur(function () {
                guardar_valor_de_celda(celda_seleccionada, columna_nombre, input);
            });

            // Escuchar el evento keydown para detectar "Enter"
            input.keydown(function (event) {
                if (event.which === 13) {
                    guardar_valor_de_celda(celda_seleccionada, columna_nombre, input);
                }
            });

        }
    });

     // Función para guardar el valor de la celda
     function guardar_valor_de_celda(celda_seleccionada, columna_nombre, input) {

        var valor_nuevo_de_celda = input.val();

        // Si no hay cambios, no realizar la solicitud AJAX
        if (celda_seleccionada.data('valor_original_guardado') === valor_nuevo_de_celda) {
            celda_seleccionada.html(celda_seleccionada.data('valor_original_guardado')); // Restaurar el valor en la celda
            flag_editando = false; // Marcar como fuera de edición
            return; // Salir de la función sin hacer nada
        }

        if (columna_nombre === "monto") {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('moneda', valor_nuevo_de_celda, celda_seleccionada);
        } else if (columna_nombre === "regimen_fiscal") {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('select', valor_nuevo_de_celda, celda_seleccionada);
        } else if (columna_nombre === "uso_cfdi") {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('select', valor_nuevo_de_celda, celda_seleccionada);
        } else if (columna_nombre === "estatus_factura") {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('select', valor_nuevo_de_celda, celda_seleccionada);
        } else {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('texto', valor_nuevo_de_celda, celda_seleccionada);
        }

        // Obtener la fila y los datos correspondientes
        var fila_tabla = table.row(celda_seleccionada.closest('tr'));
        var datos_fila_tabla = fila_tabla.data();

        // Realizar una solicitud AJAX para actualizar el dato en la base de datos
        $.ajax({
            url: method_call + "actualizar_dato_factura", // Actualiza con la ruta correcta
            method: 'POST',
            data: {
                identificador: datos_fila_tabla.identificador,
                columna: columna_nombre,
                nuevoValor: valor_nuevo_de_celda
            },
            success: function (response) {
                console.log('Dato actualizado en la base de datos');
                console.log(response);
                flag_editando = false; // Marcar como fuera de edición
            },
            error: function (xhr, status, error) {
                console.error('Error al actualizar el dato: ' + error);
                // Restaurar el valor original en caso de error
                celda_seleccionada.html(celda_seleccionada.data('valor_original_guardado'));
                flag_editando = false; // Marcar como fuera de edición
            }
        });
    }
});

// Función para obtener opciones del select 'modalidad'
async function obtener_opciones_select_estatus_pago() {
    // Realizar una solicitud AJAX para obtener las opciones de select_estatus_pago
    $.ajax({
        url: method_call + "obtener_opciones_select_estatus_pago",
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            select_estatus_pago = data;
            console.log('Opciones de estatus_pago cargadas:', select_estatus_pago);
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener opciones de estatus_pago: ' + error);
        }
    });
}

function createEditableCells(row, data, dataIndex) {
    var columnsToEdit = [5, 6, 7, 8, 9, 10, 12, 13];
    $.each(columnsToEdit, function (index, columnIndex) {
        $('td:eq(' + columnIndex + ')', row).addClass('editable-cell');
    });
}

// Función para obtener opciones del select 'regimen_fiscal'
async function obtener_opciones_select_regimen_fiscal() {
    // Realizar una solicitud AJAX para obtener las opciones de select_regimen_fiscal
    $.ajax({
        url: method_call + "obtener_opciones_select_regimen_fiscal",
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            select_regimen_fiscal = data;
            console.log('Opciones de regimen_fiscal cargadas:', select_regimen_fiscal);
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener opciones de regimen_fiscal: ' + error);
        }
    });
}

async function obtener_opciones_select_regimen_fiscal_moral() {
    // Realizar una solicitud AJAX para obtener las opciones de select_regimen_fiscal
    $.ajax({
        url: method_call + "obtener_opciones_select_regimen_fiscal_moral",
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            select_regimen_fiscal_moral = data;
            console.log('Opciones de regimen_fiscal_moral cargadas:', select_regimen_fiscal_moral);
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener opciones de regimen_fiscal_moral: ' + error);
        }
    });
}

// Función para obtener opciones del select 'uso_cfdi'
async function obtener_opciones_select_uso_cfdi() {
    // Realizar una solicitud AJAX para obtener las opciones de select_uso_cfdi
    $.ajax({
        url: method_call + "obtener_opciones_select_uso_cfdi",
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            select_uso_cfdi = data;
            console.log('Opciones de uso_cfdi cargadas:', select_uso_cfdi);
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener opciones de uso_cfdi: ' + error);
        }
    });
}

async function obtener_opciones_select_uso_cfdi_moral() {
    // Realizar una solicitud AJAX para obtener las opciones de select_uso_cfdi
    $.ajax({
        url: method_call + "obtener_opciones_select_uso_cfdi_moral",
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            select_uso_cfdi_moral = data;
            console.log('Opciones de uso_cfdi cargadas:', select_uso_cfdi_moral);
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener opciones de uso_cfdi: ' + error);
        }
    });
}


// Función para obtener opciones del select 'estatus_factura'
async function obtener_opciones_select_estatus_factura() {
    // Realizar una solicitud AJAX para obtener las opciones de select_estatus_factura
    $.ajax({
        url: method_call + "obtener_opciones_select_estatus_factura",
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            select_estatus_factura = data;
            console.log('Opciones de estatus_factura cargadas:', select_estatus_factura);
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener opciones de estatus_factura: ' + error);
        }
    });
}

function subir_archivos(factura_identificador, nombre_desarrollo, nombre_inmueble, pago_identificador, concepto, cliente_nombre, monto) {
    $('#modal_subir_archivos').modal('show');
    document.getElementById("factura_identificador").value = factura_identificador;
    document.getElementById("factura_identificador_2").value = factura_identificador;
    document.getElementById("factura_identificador_3").value = factura_identificador;
    document.getElementById("pago_identificador").innerHTML = pago_identificador;
    document.getElementById("identificador_factura").innerHTML = factura_identificador;
    document.getElementById("concepto").innerHTML = concepto;
    document.getElementById("cliente").innerHTML = cliente_nombre;
    document.getElementById("monto").innerHTML = monto;
    document.getElementById("desarrollo").innerHTML = nombre_desarrollo;
    document.getElementById("inmueble").innerHTML = nombre_inmueble;
}

function ver_archivo(url_archivo, tipo_extension, factura) {

    $('#modal_ver_archivo').modal('show');

    if ((tipo_extension == 'archivo')) {
        var etiqueta = '<iframe src="https://docs.google.com/gview?url=' + url_archivo + '&embedded=true" width="100%" height="500"></iframe>';
    } else if (tipo_extension == 'imagen') {
        var etiqueta = '<img src="' + url_archivo + '" class="img-fluid" alt="Preview">';
    } else if (tipo_extension === 'zip') {
        // Descargar carpeta ZIP con nombre predeterminado
        var nombreCarpetaZIP = 'Factura del cliente ' + factura + '.zip';
        var etiqueta = '<a class="btn btn-outline-secondary btn-lg mr-1 mb-1 btn-block" href="' + url_archivo + '" download="' + nombreCarpetaZIP + '"><i class="fa ft-download"></i> Descargar Carpeta ZIP</a>';
    }

    document.getElementById("vista_previa").innerHTML = etiqueta;
}

async function agregar_pago() {
    var proceso_venta_respuesta = await fetch(method_call + "obtener_procesos_venta_por_inmueble_identificador/" + identificador);
    var proceso_venta_datos = await proceso_venta_respuesta.json();

    $.ajax({
        url: method_call + "agregar_pago",
        method: 'POST',
        data: { proceso_venta_identificador: proceso_venta_datos.identificador },
        success: function (response) {
            console.log('success: ' + response);

            var response = JSON.parse(response);

            if (response && response.success) {
                reload_table(table);
                obtener_saldos_del_mes(identificador);
                document.getElementById('mensaje_proceso_venta').innerHTML = response.mensaje;
            } else {
                document.getElementById('mensaje_proceso_venta').innerHTML = response.error || 'Se produjo un error inesperado.';
            }
        },
        error: function (error) {
            console.log('error: ' + error);
            document.getElementById('mensaje_proceso_venta').innerHTML = error || 'Se produjo un error en la solicitud.';
        }
    });
}

async function eliminar_pago(pago_identificador) {
    $.ajax({
        url: method_call + "eliminar_pago",
        method: 'POST',
        data: { pago_identificador: pago_identificador },
        success: function (response) {
            console.log(response);

            var response = JSON.parse(response);

            if (response && response.success) {
                reload_table(table);
                obtener_saldos_del_mes(identificador);
                document.getElementById('mensaje_proceso_venta').innerHTML = response.mensaje;
            } else {
                document.getElementById('mensaje_proceso_venta').innerHTML = response.error || 'Se produjo un error inesperado.';
            }
        },
        error: function (error) {
            console.log(error);
            document.getElementById('mensaje_proceso_venta').innerHTML = error;
        }
    });
}