var table;
var actual_url = document.URL;
var method_call = "";
var flag_editando = false;

(actual_url.indexOf("index") < 0) ? method_call = "inmuebles/" : method_call = "";
$.fn.dataTable.ext.errMode = 'throw'; // Configuración de manejo de errores de DataTables

$(document).ready(function () {
    url = method_call + "obtener_tabla_index";

    table = $('#table').DataTable({
        "scrollX": true,
        "deferRender": true,
        'processing': true,
        "order": [[0, "asc"]],
        "lengthMenu": [[25, 50, 100, 250, 500, -1], [25, 50, 100, 250, 500, "Todos"]],
        "ajax": {
            "url": url,
            "type": 'POST'
        },
        "columns": [
            { "data": "id" },
            { "data": "identificador" },
            { "data": "desarrollo" },
            { "data": "nombre" },
            { "data": "tipo_inmueble" },
            { "data": "precio", "render": formato_moneda },
            { "data": "etapa" },
            { "data": "estatus_inmueble" },
            { "data": "modalidad" },
            { "data": "prototipo" },
            { "data": "tamanho_construccion", "render": formato_numero },
            { "data": "tamanho_terraza", "render": formato_numero },
            { "data": "tamanho_total", "render": formato_numero },
            { "data": "opciones" },
        ],
        rowCallback: function (row, data, index) {
            console.log(data["estatus_inmueble"]);
            if (data["estatus_inmueble"] == "Vendido") {
                $(row).find('td:eq(7)').css('background-color', '#1E9FF2');
                $(row).find('td:eq(7)').css('color', 'white');
            } else if (data["estatus_inmueble"] == "Reservado") {
                $(row).find('td:eq(7)').css('background-color', '#BCE2FB');
                $(row).find('td:eq(7)').css('color', 'white');
            } else if (data["estatus_inmueble"] == "Disponible") {
                $(row).find('td:eq(7)').css('background-color', '#28D094');
                $(row).find('td:eq(7)').css('color', 'white');
            } else if (data["estatus_inmueble"] == "Apartado") {
                $(row).find('td:eq(7)').css('background-color', '#BFF1DF');
                $(row).find('td:eq(7)').css('color', 'white');
            } else if (data["estatus_inmueble"] == "Proceso") {
                $(row).find('td:eq(7)').css('background-color', '#F6BB42');
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

    var buttons = new $.fn.dataTable.Buttons(table, {
        buttons: [
            {
                extend: 'excelHtml5',
                className: 'custom-button'

            }
        ]
    }).container().appendTo($('#buttons'));
});