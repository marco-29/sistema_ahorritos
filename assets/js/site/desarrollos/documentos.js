$(document).ready(function () {

    'use strict';

    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');

        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);

});

// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
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

$('#modal_ver_archivo').on('hidden.bs.modal', function () {

    var etiqueta = '';

    document.getElementById("vista_previa").innerHTML = etiqueta;
})

function eliminar_archivo(url_archivo, carpeta, archivo, servicio, url) {

    $('#modal_eliminar_archivo').modal('show');

    document.getElementById("url_archivo").value = url_archivo;
    document.getElementById("carpeta").value = carpeta;
    document.getElementById("archivo").value = archivo;
    document.getElementById("servicio").value = servicio;
    document.getElementById("url").value = url;
}
