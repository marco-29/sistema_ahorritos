<?php defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('mostrar_mensaje_error_error')) {
    function mostrar_mensaje_error_error()
    {
        return 'Ha ocurrido un error, por favor si el error persiste contacte al administrador.';
    }
}

if (!function_exists('mostrar_mensaje_error_solicitud')) {
    function mostrar_mensaje_error_solicitud()
    {
        return 'No fue posible procesar su solicitud, por favor compruebe la información ó si el error persiste contacte al administrador.';
    }
}
