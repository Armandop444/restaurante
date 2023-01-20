const btnReporte = document.querySelector("#btnReporte");
const nombreR = document.querySelector("#nombreR");
const frame = document.querySelector("#frameReporte");
const fechaI = document.querySelector("#fechaI");
const fechaF = document.querySelector("#fechaF");
const API = new Api();

eventListeners();

function eventListeners() {
    document.addEventListener("DOMContentLoaded", cargarDatos);
    btnReporte.addEventListener("click", reporte);
}

function cargarDatos() {
    API.loadRestaurantes()
        .then((data) => {
            optionsRestaurante(data.records);
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}
function optionsRestaurante(records) {
    nombreR.innerHTML = "";
    nombreR.innerHTML = "<option value='0' selected>Todos</option>"
    records.forEach(item => {
        const { idrestaurante, nombre_restaurante } = item;
        const option = document.createElement("option");
        option.value = idrestaurante;
        option.textContent = nombre_restaurante;
        nombreR.append(option);

    });
}

function reporte() {
    frame.src = `${BASE_API}reportes/getReporte?id=${nombreR.value}&fechaI=${fechaI.value}&fechaF=${fechaF.value}`;
    limpiar()
}
function limpiar() {
    fechaI.value = '';
    fechaF.value = '';
}