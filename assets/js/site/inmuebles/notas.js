// Variables
var actual_url = document.URL;
var method_call = "";
var identificador = window.location.pathname.split('/').pop();
var url;

// Configuraciones
(actual_url.indexOf("index") < 0) ? method_call = "../" : method_call = "";
$.fn.dataTable.ext.errMode = 'throw'; // Configuración de manejo de errores de DataTables

$(document).ready(function () {
    // Inicializar
    obtener_saldos_del_mes(identificador)
});

async function obtener_saldos_del_mes(identificador) {

    var proceso_venta_respuesta = await fetch(method_call + "obtener_procesos_venta_por_inmueble_identificador/" + identificador);
    var proceso_venta_datos = await proceso_venta_respuesta.json();

    document.getElementById('identificador').innerHTML = proceso_venta_datos.identificador;
}

function agregar_nota(identificador) {
    $('#modal_nota_inmueble').modal('show');
    document.getElementById("identificador").value = identificador;
}