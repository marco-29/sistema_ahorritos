$(document).ready(function () {

    'use strict';

    $('.select2').select2();

    obtener_detalles_inmueble();
});

var input_precio_venta = document.getElementById("precio_venta");

var flag_enganche = false;

input_precio_venta.addEventListener('change', (event) => {
    calculo_inicial();
});

document.getElementById("apartado").addEventListener('change', (event) => {
    calculo_inicial();
});

document.getElementById("enganche").addEventListener('change', (event) => {
    calculo_inicial();
});

document.getElementById("no_pagos").addEventListener('change', (event) => {
    calculo_inicial();
});

function calculo_inicial() {
    valor_precio_venta = parseFloat(input_precio_venta.value);
    if (!valor_precio_venta) {
        valor_precio_venta = parseFloat(0);
    }
    valor_precio_venta = valor_precio_venta.toFixed(2);
    console.log(valor_precio_venta);

    valor_apartado = parseFloat(document.getElementById('apartado').value);
    if (!valor_apartado) {
        valor_apartado = parseFloat(0);
    }
    valor_apartado = valor_apartado.toFixed(2);
    console.log(valor_precio_venta);

    console.log(flag_enganche);
    if (!flag_enganche) {
        valor_enganche = (valor_precio_venta * 0.35) - valor_apartado;
        flag_enganche = true;
    } else {
        valor_enganche = parseFloat(document.getElementById('enganche').value);
        if (!valor_enganche || valor_enganche == parseFloat(0)) {
            valor_enganche = parseFloat(0);
        } else {
            valor_enganche = valor_enganche;
        }
    }
    valor_enganche = valor_enganche.toFixed(2);
    console.log(valor_enganche);
    document.getElementById('enganche').value = valor_enganche;
    console.log(flag_enganche);

    valor_saldo = (valor_precio_venta - valor_enganche) - valor_apartado;
    valor_saldo = valor_saldo.toFixed(2);
    console.log(valor_saldo);
    document.getElementById('saldo').value = valor_saldo;

    valor_no_pagos = parseFloat(document.getElementById('no_pagos').value);
    if (!valor_no_pagos) {
        valor_no_pagos = parseFloat(1);
    }
    valor_no_pagos = valor_no_pagos.toFixed(2);
    console.log(valor_no_pagos);

    valor_cantidad_pago = valor_saldo / valor_no_pagos;
    valor_cantidad_pago = valor_cantidad_pago.toFixed(2);
    console.log(valor_cantidad_pago);
    document.getElementById('cantidad_pago').value = valor_cantidad_pago;
}

$('#identificador').on('change', function () {
    obtener_detalles_inmueble();
});

function obtener_detalles_inmueble() {
    var select_inmueble = $('#identificador').val();

    fetch('./../obtener_detalles_inmueble/' + select_inmueble)
        .then(response => response.json())
        .then(result => {
            var nombre = result.nombre;
            var identificador = result.identificador;
            var desarrollo_nombre = result.desarrollo_nombre;
            var tipo_inmueble = result.tipo_inmueble;
            var precio = parseFloat(result.precio);
            var etapa = result.etapa;
            var prototipo = result.prototipo;

            nombre = nombre.toUpperCase();
            desarrollo_nombre = desarrollo_nombre.toUpperCase();
            tipo_inmueble = formato_capitalizar(tipo_inmueble);
            precio = precio.toLocaleString('es-MX', { style: 'currency', currency: 'MXN', minimumFractionDigits: 2 })

            document.getElementById('detalles_inmueble').innerHTML = '<ul class="list-group mb-1 card">' +
                '<li class="list-group-item d-flex justify-content-between lh-condensed">' +
                '<div>' +
                '<h6 class="my-0">Nombre</h6>' +
                '<small class="text-muted">Identificador</small>' +
                '</div>' +
                '<span class="text-muted text-right"><b>' + nombre + '</b><br><small>' + identificador + '</small></span>' +
                '</li>' +
                '<li class="list-group-item d-flex justify-content-between lh-condensed">' +
                '<div>' +
                '<h6 class="my-0">Desarrollo</h6>' +
                '<small class="text-muted">Tipo</small>' +
                '</div>' +
                '<span class="text-muted text-right"><b>' + desarrollo_nombre + '</b><br><small>' + tipo_inmueble + '</small></span>' +
                '</li>' +
                '<li class="list-group-item d-flex justify-content-between lh-condensed">' +
                '<div>' +
                '<h6 class="my-0">Precio de lista</h6>' +
                '<small class="text-muted">Etapa lista</small>' +
                '</div>' +
                '<span class="text-muted text-right"><b>' + precio + '</b><br><small>' + etapa + '</small></span>' +
                '</li>' +
                '<li class="list-group-item d-flex justify-content-between">' +
                '<span>Prototipo</span>' +
                '<span class="text-muted text-right"><b>' + prototipo + '</b></span>' +
                '</li>' +
                '</ul>';
        })
        .catch(error => {
            document.getElementById('detalles_inmueble').innerHTML = '';
        });
}