var table;
var actual_url = document.URL;
var method_call = "";
var identificador = window.location.pathname.split('/').pop();
var flag_editando = false; // Variable para rastrear el estado de edición
var select_prototipo = [];
var select_tipo_inmueble = [];
var select_modalidad = [];
var select_estatus_inmueble = [];
var select_clientes = [];
var select_etapa = [];

(actual_url.indexOf("index") < 0) ? method_call = "../" : method_call = "";
$.fn.dataTable.ext.errMode = 'throw'; // Configuración de manejo de errores de DataTables

$(document).ready(function () {
    url = method_call + "obtener_inmuebles_por_desarrollo/" + identificador;
    obtener_opciones_select_tipo_inmueble(); // Obtención de opciones para el select 'tipo_inmueble'
    obtener_opciones_select_prototipo(); // Obtención de opciones para el select 'prototipo'
    obtener_opciones_select_modalidad(); // Obtención de opciones para el select 'modalidad'
    obtener_opciones_select_estatus_inmueble(); // Obtención de opciones para el select 'estatus_inmueble'
    obtener_opciones_select_etapa(); // Obtención de opciones para el select 'etapa'

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
        "createdRow": createEditableCells,
        rowCallback: function (row, data, index) {
            console.log(data["estatus_inmueble"]);
            if (data["estatus_inmueble"] == "Vendido") {
                $(row).find('td:eq(6)').css('background-color', '#1E9FF2');
                $(row).find('td:eq(6)').css('color', 'white');
            } else if (data["estatus_inmueble"] == "Reservado") {
                $(row).find('td:eq(6)').css('background-color', '#BCE2FB');
                $(row).find('td:eq(6)').css('color', 'white');
            } else if (data["estatus_inmueble"] == "Disponible") {
                $(row).find('td:eq(6)').css('background-color', '#28D094');
                $(row).find('td:eq(6)').css('color', 'white');
            } else if (data["estatus_inmueble"] == "Apartado") {
                $(row).find('td:eq(6)').css('background-color', '#BFF1DF');
                $(row).find('td:eq(6)').css('color', 'white');
            } else if (data["estatus_inmueble"] == "Proceso") {
                $(row).find('td:eq(6)').css('background-color', '#F6BB42');
                $(row).find('td:eq(6)').css('color', 'white');
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
            var celda_seleccionada = $(this);
            var columna_indice = celda_seleccionada.index(); // Obtener el nombre de la columna según el índice
            var columna_nombres_list = table.settings().init().columns;
            var columna_nombre = columna_nombres_list[columna_indice].data;
            var valor_original_de_celda = celda_seleccionada.text();

            if (columna_nombre === "tipo_inmueble") {
                var input = generar_campo_de_celda_a_editar('select', valor_original_de_celda, select_tipo_inmueble);
            } else if (columna_nombre === "precio") {
                var input = generar_campo_de_celda_a_editar('numero', valor_original_de_celda, null)
            } else if (columna_nombre === "tamanho_construccion" || columna_nombre === "tamanho_terraza" || columna_nombre === "tamanho_total") {
                var input = generar_campo_de_celda_a_editar('numero', valor_original_de_celda, null)
            } else if (columna_nombre === "prototipo") {
                var input = generar_campo_de_celda_a_editar('select', valor_original_de_celda, select_prototipo);
            } else if (columna_nombre === "modalidad") {
                var input = generar_campo_de_celda_a_editar('select', valor_original_de_celda, select_modalidad);
            } else if (columna_nombre === "estatus_inmueble") {
                var input = generar_campo_de_celda_a_editar('select', valor_original_de_celda, select_estatus_inmueble);
            } else if (columna_nombre === "etapa") {
                var input = generar_campo_de_celda_a_editar('select', valor_original_de_celda, select_etapa);
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

        if (columna_nombre === "tipo_inmueble") {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('select', valor_nuevo_de_celda, celda_seleccionada);
        } else if (columna_nombre === "precio") {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('moneda', valor_nuevo_de_celda, celda_seleccionada);
        } else if (columna_nombre === "tamanho_construccion" || columna_nombre === "tamanho_terraza" || columna_nombre === "tamanho_total") {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('numero', valor_nuevo_de_celda, celda_seleccionada);
        } else if (columna_nombre === "prototipo") {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('select mayusculas', valor_nuevo_de_celda, celda_seleccionada);
        } else if (columna_nombre === "modalidad") {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('select', valor_nuevo_de_celda, celda_seleccionada);
        } else if (columna_nombre === "estatus_inmueble") {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('select', valor_nuevo_de_celda, celda_seleccionada);
        } else if (columna_nombre === "etapa") {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('select', valor_nuevo_de_celda, celda_seleccionada);
        } else {
            valor_nuevo_de_celda = generar_salida_de_celda_editada('texto', valor_nuevo_de_celda, celda_seleccionada);
        }

        // Obtener la fila y los datos correspondientes
        var fila_tabla = table.row(celda_seleccionada.closest('tr'));
        var datos_fila_tabla = fila_tabla.data();

        // Verificar si el estatus es 'vendido' y la columna es 'etapa' o 'precio'
        if (datos_fila_tabla.estatus_inmueble === 'Vendido' && (columna_nombre === 'etapa' || columna_nombre === 'precio')) {
            celda_seleccionada.html(celda_seleccionada.data('valor_original_guardado')); // Restaurar el valor en la celda
            celda_seleccionada.addClass('no-modificable'); // Agregar clase para resaltar la celda
            flag_editando = false; // Marcar como fuera de edición

            // Aplicar la clase 'no-modificable' por un segundo
            aplicarClasePorSegundo(celda_seleccionada, 'no-modificable');

            return; // No realizar la solicitud AJAX
        } else {
            // Si la celda es modificable, remover la clase 'no-modificable' si está presente
            celda_seleccionada.removeClass('no-modificable');
        }

        // Realizar una solicitud AJAX para actualizar el dato en la base de datos
        $.ajax({
            url: method_call + "actualizar_dato", // Actualiza con la ruta correcta
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
                // if (columna_nombre === "estatus_inmueble") {
                //     reload_table(table);
                // }
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

// Función para aplicar una clase por un segundo
function aplicarClasePorSegundo(elemento, clase) {
    // Agregar la clase
    elemento.addClass(clase);

    // Después de unos segundos, quitar la clase
    setTimeout(function () {
        elemento.removeClass(clase);
    }, 3000);
}

// Función para obtener opciones del select 'prototipo'
async function obtener_opciones_select_tipo_inmueble() {
    // Realizar una solicitud AJAX para obtener las opciones de prototipos
    $.ajax({
        url: method_call + "obtener_opciones_select_tipo_inmueble",
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            select_tipo_inmueble = data;
            console.log('Opciones de tipo_inmueble cargadas:', select_tipo_inmueble);
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener opciones de tipo_inmueble: ' + error);
        }
    });
}

// Función para obtener opciones del select 'prototipo'
async function obtener_opciones_select_prototipo() {
    // Realizar una solicitud AJAX para obtener las opciones de prototipos
    $.ajax({
        url: method_call + "obtener_opciones_select_prototipo",
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            select_prototipo = data;
            console.log('Opciones de prototipo cargadas:', select_prototipo);
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener opciones de prototipo: ' + error);
        }
    });
}

// Función para obtener opciones del select 'modalidad'
async function obtener_opciones_select_modalidad() {
    // Realizar una solicitud AJAX para obtener las opciones de modalidads
    $.ajax({
        url: method_call + "obtener_opciones_select_modalidad",
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            select_modalidad = data;
            console.log('Opciones de modalidad cargadas:', select_modalidad);
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener opciones de modalidad: ' + error);
        }
    });
}

// Función para obtener opciones del select 'modalidad'
async function obtener_opciones_select_estatus_inmueble() {
    // Realizar una solicitud AJAX para obtener las opciones de modalidads
    $.ajax({
        url: method_call + "obtener_opciones_select_estatus_inmueble",
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            select_estatus_inmueble = data;
            console.log('Opciones de estatus_inmueble cargadas:', select_estatus_inmueble);
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener opciones de estatus_inmueble: ' + error);
        }
    });
}

// Función para obtener opciones del select 'etapa'
async function obtener_opciones_select_etapa() {
    // Realizar una solicitud AJAX para obtener las opciones de modalidads
    $.ajax({
        url: method_call + "obtener_opciones_select_etapa",
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            select_etapa = data;
            console.log('Opciones de estapa cargadas:', select_etapa);
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener opciones de etapa: ' + error);
        }
    });
}

// Función para marcar las celdas editables en la tabla
function createEditableCells(row, data, dataIndex) {
    var columnsToEdit = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11]; // Índices de columnas editables
    $.each(columnsToEdit, function (index, columnIndex) {
        $('td:eq(' + columnIndex + ')', row).addClass('editable-cell');
    });
}

function subir_etapa() {

}