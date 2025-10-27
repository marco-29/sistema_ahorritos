// Variables
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
            { "data": "estatus_pago" },
            { "data": "estatus" },
            { "data": "fecha_registro" },
            { "data": "fecha_actualizacion" },
            { "data": "opciones" },
        ],
        rowCallback: function (row, data, index) {
            console.log(data["estatus_pago"]);
            if (data["estatus_pago"] == "Cobrado") {
                $(row).find('td:eq(7)').css('background-color', '#37BC9B');
                $(row).find('td:eq(7)').css('color', 'white');
            } else if (data["estatus_pago"] == "Por validar") {
                $(row).find('td:eq(7)').css('background-color', '#F6BB42');
                $(row).find('td:eq(7)').css('color', 'white');
            } else if (data["estatus_pago"] == "Por cobrar") {
                $(row).find('td:eq(7)').css('background-color', '#3BAFDA');
                $(row).find('td:eq(7)').css('color', 'white');
            } else if (data["estatus_pago"] == "Vencido") {
                $(row).find('td:eq(7)').css('background-color', '#B3B3B3');
                $(row).find('td:eq(7)').css('color', 'white');
            } else if (data["estatus_pago"] == "No valido") {
                $(row).find('td:eq(7)').css('background-color', '#f08383');
                $(row).find('td:eq(7)').css('color', 'white');
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
});

function ver_archivo(url_archivo, tipo_extension) {

    $('#modal_ver_archivo').modal('show');

    if (tipo_extension == 'archivo') {
        var etiqueta = '<iframe src="https://docs.google.com/gview?url=' + url_archivo + '&embedded=true" width="100%" height="500"></iframe>';
    } else if (tipo_extension == 'imagen') {
        var etiqueta = '<img src="' + url_archivo + '" class="img-fluid" alt="Preview">';

    }

    document.getElementById("vista_previa").innerHTML = etiqueta;
}
