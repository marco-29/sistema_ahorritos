document.addEventListener('DOMContentLoaded', function () {
    // obtener_total_clientes();
    obtener_total_clientes_prospectos();
    obtener_total_clientes_compradores();
    obtener_total_inmuebles();
    obtener_total_inmuebles_en_proceso();
});

async function obtener_total_clientes() {
    try {
        const data = await handleFetch('inicio/obtener_total_clientes');
        console.log(data);
        document.getElementById('total_clientes').innerText = data.total_clientes;
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
}

async function obtener_total_clientes_prospectos() {
    try {
        const data = await handleFetch('inicio/obtener_total_clientes_prospectos');
        console.log(data);
        document.getElementById('total_clientes_prospectos').innerText = data.total_clientes_prospectos;
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
}

async function obtener_total_clientes_compradores() {
    try {
        const data = await handleFetch('inicio/obtener_total_clientes_compradores');
        console.log(data);
        document.getElementById('total_clientes_compradores').innerText = data.total_clientes_compradores;
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
}

async function obtener_total_inmuebles() {
    try {
        const data = await handleFetch('inicio/obtener_total_inmuebles');
        console.log(data);
        document.getElementById('total_inmuebles').innerText = data.total_inmuebles;
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
}

async function obtener_total_inmuebles_en_proceso() {
    try {
        const data = await handleFetch('inicio/obtener_total_inmuebles_en_proceso');
        console.log(data);
        document.getElementById('total_inmuebles_en_proceso').innerText = data.total_inmuebles_en_proceso;
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
}

async function handleFetch(url) {
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.status} - ${response.statusText}`);
        }
        return await response.json();
    } catch (error) {
        console.error('Error en la solicitud:', error);
        throw error;
    }
}
