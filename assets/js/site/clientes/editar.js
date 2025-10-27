document.addEventListener("DOMContentLoaded", function () {
    $('.select2').select2();
});
function agregar_nota(identificador) {
    $('#modal_nota_cliente').modal('show');
    document.getElementById("identificador").value = identificador;
}