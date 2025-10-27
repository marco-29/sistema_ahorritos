document.addEventListener("DOMContentLoaded", function () {
    obtener_catalogo_index('tipo_inmueble_desarrollos');
});

async function obtener_catalogo_index(etiqueta_id = null) {
    var resultados = document.getElementById(etiqueta_id);
    resultados.innerHTML = '<p><b>Espere un momento por favor…</b></p>';

    fetch("desarrollos/obtener_catalogo_index/" + etiqueta_id, {
        method: "POST",
        headers: {
            "Content-Type": "application/json;charset=UTF-8"
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            resultados.innerHTML = "";

            data.forEach(item => {
                resultados.innerHTML += item;
            });
        })
        .catch(error => {
            console.error("Error en la solicitud:", error);
        });
}
