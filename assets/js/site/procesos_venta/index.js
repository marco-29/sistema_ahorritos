var table;
var actual_url = document.URL;
var method_call = "";
(actual_url.indexOf("index") < 0) ? method_call = "procesos_venta/" : method_call = "";
obtener_reporte_ventas_por_desarrollo();

/**
 * Este línea desactiva los mensajes de error de DataTables();
 */
$.fn.dataTable.ext.errMode = 'throw';

document.addEventListener("DOMContentLoaded", function () {


    table = $('#table').DataTable({
        "scrollX": true,
        "deferRender": true,
        'processing': true,
        "order": [[0, "desc"]],
        "lengthMenu": [[25, 50, 100, 250, 500, -1], [25, 50, 100, 250, 500, "Todos"]],
        "ajax": {
            "url": method_call + "obtener_tabla_index",
            "type": 'POST'
        },
        "columns": [
            { "data": "id" },
            { "data": "identificador" },
            { "data": "inmuebles_nodo_nombre" },
            { "data": "inmuebles_nombre" },
            { "data": "inmuebles_tamanho_total" },
            { "data": "precio_lista" },
            { "data": "precio_venta" },
            { "data": "apartado" },
            { "data": "enganche" },
            { "data": "pagado" },
            { "data": "no_pagos" },
            { "data": "frecuencia" },
            { "data": "fecha_inicio" },
            { "data": "estatus_procesos" },
            { "data": "estatus" },
            { "data": "fecha_registro" },
            { "data": "fecha_actualizacion" },
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
        },
    });

    var buttons = new $.fn.dataTable.Buttons(table, {
        buttons: [
            'excelHtml5',
        ]
    }).container().appendTo($('#buttons'));

});

async function obtener_reporte_ventas_por_desarrollo() {
    var resultados = document.getElementById('reporte_desarrollos');
    resultados.innerHTML = '<p><b>Espere un momento por favor…</b></p>';

    fetch(method_call + "obtener_reporte_ventas_por_desarrollo/", {
        method: "POST",
        headers: {
            "Content-Type": "application/json;charset=UTF-8"
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            // Limpiar el contenido anterior
            resultados.innerHTML = "";

            resultados.innerHTML += data;
        })
        .catch(error => {
            console.error("Error en la solicitud:", error);
        });
}
