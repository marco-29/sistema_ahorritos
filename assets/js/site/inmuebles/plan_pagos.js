var table;
var actual_url = document.URL;
var method_call = "";
var identificador = window.location.pathname.split('/').pop();
var url;
var flag_editando = false;
var select_estatus_pago = [];

// Configuraciones
(actual_url.indexOf("index") < 0) ? method_call = "../" : method_call = "";
$.fn.dataTable.ext.errMode = 'throw'; // Configuración de manejo de errores de DataTables

$(document).ready(function () {
    // Inicializar
    url = method_call + "obtener_tabla_ver_proceso_venta/" + identificador
    obtener_saldos_del_mes(identificador)
    obtener_opciones_select_estatus_pago(); // Obtención de opciones para el select 'estatus_pago'

    table = $('#table').DataTable({
        "searching": true,
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
            { "data": "fecha_programada" },
            { "data": "fecha_pago" },
            { "data": "concepto" },
            { "data": "monto", "render": formato_moneda },
            { "data": "archivo_comprobante_pago" },
            { "data": "archivo_comprobante_pago_expediente" },
            { "data": "estatus_pago" },
            { "data": "estatus" },
            { "data": "fecha_registro" },
            { "data": "fecha_actualizacion" },
            { "data": "opciones" },
        ],
        "createdRow": createEditableCells,
        rowCallback: function (row, data, index) {
            console.log(data["estatus_pago"]);

            if (data["estatus_pago"] == "Cobrado") {
                $(row).find('td:eq(8)').css('background-color', '#37BC9B');
                $(row).find('td:eq(8)').css('color', 'white');
            } else if (data["estatus_pago"] == "Por validar") {
                $(row).find('td:eq(8)').css('background-color', '#F6BB42');
                $(row).find('td:eq(8)').css('color', 'white');
            } else if (data["estatus_pago"] == "Por cobrar") {
                $(row).find('td:eq(8)').css('background-color', '#3BAFDA');
                $(row).find('td:eq(8)').css('color', 'white');
            } else if (data["estatus_pago"] == "Vencido") {
                $(row).find('td:eq(8)').css('background-color', '#B3B3B3');
                $(row).find('td:eq(8)').css('color', 'white');
            } else if (data["estatus_pago"] == "No valido") {
                $(row).find('td:eq(8)').css('background-color', '#f08383');
                $(row).find('td:eq(8)').css('color', 'white');
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

            if (columna_nombre === "fecha_programada") {
                var input = generar_campo_de_celda_a_editar('fecha', valor_original_de_celda, null);
            } else if (columna_nombre === "fecha_pago") {
                var input = generar_campo_de_celda_a_editar('fecha', valor_original_de_celda, null);
            } else if (columna_nombre === "monto") {
                var input = generar_campo_de_celda_a_editar('numero', valor_original_de_celda, null)
            } else if (columna_nombre === "estatus_pago") {
                var input = generar_campo_de_celda_a_editar('select', valor_original_de_celda, select_estatus_pago);
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

        if (columna_nombre === "fecha_programada") {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('fecha', valor_nuevo_de_celda, celda_seleccionada);
        } else if (columna_nombre === "fecha_pago") {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('fecha', valor_nuevo_de_celda, celda_seleccionada);
        } else if (columna_nombre === "monto") {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('moneda', valor_nuevo_de_celda, celda_seleccionada);
        } else if (columna_nombre === "estatus_pago") {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('select', valor_nuevo_de_celda, celda_seleccionada);
        } else {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('texto', valor_nuevo_de_celda, celda_seleccionada);
        }

        // Obtener la fila y los datos correspondientes
        var fila_tabla = table.row(celda_seleccionada.closest('tr'));
        var datos_fila_tabla = fila_tabla.data();

        // Realizar una solicitud AJAX para actualizar el dato en la base de datos
        $.ajax({
            url: method_call + "actualizar_dato_pago", // Actualiza con la ruta correcta
            method: 'POST',
            data: {
                identificador: datos_fila_tabla.identificador,
                columna: columna_nombre,
                nuevoValor: valor_nuevo_de_celda
            },
            success: function (response) {
                console.log('Dato actualizado en la base de datos');
                console.log(response);

                console.log(table.row(celda_seleccionada).data())

                flag_editando = false; // Marcar como fuera de edición
                if (columna_nombre === "monto" || columna_nombre === "estatus_pago") {
                    obtener_saldos_del_mes(identificador);
                }
                if (columna_nombre === "fecha_programada") {
                    reload_table(table);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error al actualizar el dato: ' + error);
                // Restaurar el valor original en caso de error
                celda_seleccionada.html(celda_seleccionada.data('valor_original_guardado'));
                flag_editando = false; // Marcar como fuera de edición
            }
        });
    }

    tabla_deber_ser = $('#tabla_deber_ser').DataTable({
        "searching": true,
        "scrollX": true,
        "deferRender": true,
        'processing': true,
        "order": [[2, "asc"]],
        "lengthMenu": [[25, 50, 100, 250, 500, -1], [25, 50, 100, 250, 500, "Todos"]],
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

    tabla_ser = $('#tabla_ser').DataTable({
        "searching": true,
        "scrollX": true,
        "deferRender": true,
        'processing': true,
        "order": [[2, "asc"]],
        "lengthMenu": [[25, 50, 100, 250, 500, -1], [25, 50, 100, 250, 500, "Todos"]],
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
});

async function obtener_saldos_del_mes(identificador) {

    document.getElementById('mensaje_proceso_venta').innerHTML = '<i class="fa fa-spinner spinner"></i>&nbsp;Espere…';

    var proceso_venta_respuesta = await fetch(method_call + "obtener_procesos_venta_por_inmueble_identificador/" + identificador);
    var proceso_venta_datos = await proceso_venta_respuesta.json();

    console.log('proceso de ventas: ', proceso_venta_datos);

    document.getElementById('inmueble').innerHTML = proceso_venta_datos.inmueble + ' (' + proceso_venta_datos.inmuebles_nodo_nombre + ')';
    document.getElementById('inmuebles_tamanho_total').innerHTML = proceso_venta_datos.inmuebles_tamanho_total;
    document.getElementById('precio_lista').innerHTML = '$' + proceso_venta_datos.precio_lista + ' (' + 'Etapa ' + proceso_venta_datos.inmuebles_etapa + ')';
    document.getElementById('precio_venta').innerHTML = '$' + proceso_venta_datos.precio_venta;
    document.getElementById('total_tabla').innerHTML = '$' + proceso_venta_datos.total_tabla;
    document.getElementById('pagado').innerHTML = '$' + proceso_venta_datos.pagado;
    document.getElementById('por_validar').innerHTML = '$' + proceso_venta_datos.por_validar;
    document.getElementById('por_cobrar').innerHTML = '$' + proceso_venta_datos.por_cobrar;
    document.getElementById('vencido').innerHTML = '$' + proceso_venta_datos.vencido;
    document.getElementById('no_pagos').innerHTML = proceso_venta_datos.no_pagos;
    document.getElementById('frecuencia').innerHTML = proceso_venta_datos.frecuencia;
    document.getElementById('fecha_inicio').innerHTML = proceso_venta_datos.fecha_inicio;
    document.getElementById('mensaje_proceso_venta').innerHTML = null;


}

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

// Función para marcar las celdas editables en la tabla
function createEditableCells(row, data, dataIndex) {
    var columnsToEdit = [2, 3, 4, 5, 8]; // Índices de columnas editables
    $.each(columnsToEdit, function (index, columnIndex) {
        $('td:eq(' + columnIndex + ')', row).addClass('editable-cell');
    });
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

function subir_comprobante_pago(pago_identificador) {
    $('#modal_subir_comprobante_pago').modal('show');
    document.getElementById("pago_identificador").value = pago_identificador;
}

function subir_comprobante_pago_expediente(pago_identificador) {
    $('#modal_subir_comprobante_pago_expediente').modal('show');
    document.getElementById("pago_identificador_expediente").value = pago_identificador;
}

function ver_archivo(url_archivo, tipo_extension) {

    $('#modal_ver_archivo').modal('show');

    if (tipo_extension == 'archivo') {
        var etiqueta = '<iframe src="https://docs.google.com/gview?url=' + url_archivo + '&embedded=true" width="100%" height="500"></iframe>';
    } else if (tipo_extension == 'imagen') {
        var etiqueta = '<img src="' + url_archivo + '" class="img-fluid" alt="Preview">';

    }

    document.getElementById("vista_previa").innerHTML = etiqueta;
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