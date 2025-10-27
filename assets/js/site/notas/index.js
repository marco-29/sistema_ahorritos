var table;

var actual_url = document.URL;
var method_call = "";
var select_modulo = [];

if (actual_url.indexOf("index") < 0) {
    method_call = "notas/";
}

/**
 * Este línea desactiva los mensajes de error de DataTables();
 */
$.fn.dataTable.ext.errMode = 'throw';

$(document).ready(function () {
    obtener_opciones_select_modulo(); // Obtención de opciones para columna 'modulo'

    var table = $('#table').DataTable({
        "searching": true,
        "scrollX": true,
        "deferRender": true,
        'processing': true,
        "order": [[0, "asc"]],
        "lengthMenu": [[25, 50, 100, 250, 500, -1], [25, 50, 100, 250, 500, "Todos"]],
        "ajax": {
            "url": method_call + "obtener_tabla_index",
            "type": 'POST'
        },
        "columns": [
            { "data": "id" },
            { "data": "identificador" },
            { "data": "usuario_identificador" },
            { "data": "origen_modulo" },
            { "data": "origen_identificador" },
            { "data": "nota" },
            { "data": "fecha_registro" },
            { "data": "opciones" },
        ],
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

// Función para obtener opciones del select 'modalidad'
async function obtener_opciones_select_modulo() {
    // Realizar una solicitud AJAX para obtener las opciones de select_estatus_pago
    $.ajax({
        url: method_call + "obtener_opciones_select_modulo",
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            select_modulo = data;
            console.log('Opciones de modulo cargadas:', select_modulo);
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener opciones de modulo: ' + error);
        }
    });
}

function eliminar(identificador) {
    $('#modal_eliminar').modal('show');
    document.getElementById("identificador").value = identificador;
}