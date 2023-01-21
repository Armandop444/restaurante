//Mando a buscar al btnAgegar para abrir el formulario
const btnNuevo = document.querySelector("#btnAgregar");
const tableContent = document.querySelector("#contentTable table tbody");
const panelDatosRestaurante = document.querySelector("#panelDatosRestaurante");
const panelFormularioRestaurante = document.querySelector("#panelFormularioRestaurante");
const mensaje = document.querySelector("#mensajeDatos");
const searchText = document.querySelector("#txtSearch");
const pagination = document.querySelector(".pagination");
const btnCancelar = document.querySelector("#btnCancelar");
const divFoto = document.querySelector("#divFoto");
const inputFoto = document.querySelector("#foto");
const span = document.querySelector("#spanClick");
const form = document.querySelector("#form");
const recordShow = 5;
const API = new Api();
const objDatos = {
    records: [],
    recordsFilter: [],
    currentPage: 1,
    filter: "",
    markers: []
};
let marker;
let map;

eventListeners();

function eventListeners() {
    btnNuevo.addEventListener("click", agregarRestaurante);
    document.addEventListener("DOMContentLoaded", cargarDatos);
    searchText.addEventListener("input", filtro);
    btnCancelar.addEventListener("click", cancelarRestaurante);
    divFoto.addEventListener("click", agregarFoto);
    inputFoto.addEventListener("change", actualizarFoto);
    form.addEventListener("submit", guardarRestaurante);
}

function cargarDatos() {
    // console.log("Datos Cargados");
    API.loadRestaurantes().then(data => {
        if (data.success) {
            objDatos.records = data.records;
            objDatos.currentPage = 1;
            crearTabla();
        } else {
            mensaje.textContent = data.msg;
        }
    }).catch(error => {
        console.error("Error: ", error);
    });

}

//agregar y cancelar muestran y ocultan los paneles de la tabla y formulario de crear
function agregarRestaurante() {
    panelDatosRestaurante.classList.add("d-none");
    panelFormularioRestaurante.classList.remove("d-none");
    initMapForm();
}

function cancelarRestaurante() {
    panelDatosRestaurante.classList.remove("d-none");
    panelFormularioRestaurante.classList.add("d-none");
    cargarDatos();
    limpiarForm();
}

// Guardar Restaurante
function guardarRestaurante(e) {
    e.preventDefault();
    const formData = new FormData(form);
    API.saveRestaurante(formData).then(data => {
        if (data.success) {
            cancelarRestaurante();
            Swal.fire({
                icon: 'info',
                text: data.msg
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.msg
            });
        }
    }).catch(error => {
        console.error("Error", error);
    });
}
function editarRestaurante(id) {
    limpiarForm(1);

    panelDatosRestaurante.classList.add("d-none");
    panelFormularioRestaurante.classList.remove("d-none");
    API.getOneRestaurante(id).then(data => {
        if (data.success) {
            mostrarDatosForm(data.records[0]);
        } else {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: data.msg
            });
        }
    }).catch(error => {
        console.error("Error", error);
    });
}

function eliminarRestaurante(id) {
    Swal.fire({
        title: "¿Desea eliminar el registro?",
        showDenyButton: true,
        confirmButtonText: "Si",
        denyButtonText: "No"
    }).then(result => {
        if (result.isConfirmed) {
            API.deleteRestaurante(id).then(data => {
                if (data.success) {
                    cancelarRestaurante();
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: data.msg
                    });
                }
            }).catch(error => {
                console.error("Error", error);
            });
        }
    });
}

//funcion para añadir una foto con preview
function agregarFoto() {
    inputFoto.click();
}

function mostrarDatosForm(record) {
    const { idrestaurante, nombre_restaurante, direccion, telefono, contacto, fecha_ingreso, foto, latitud, longitud } = record;
    document.querySelector("#idrestaurante").value = idrestaurante;
    document.querySelector("#nombre").value = nombre_restaurante;
    document.querySelector("#direccion").value = direccion;
    document.querySelector("#telefono").value = telefono;
    document.querySelector("#contacto").value = contacto;
    document.querySelector("#fechaI").value = fecha_ingreso;
    divFoto.innerHTML = `<img src="${foto}" class="h-100 w-100" style="object-fit:contain;">`;
    document.querySelector("#lat").value = latitud;
    document.querySelector("#lon").value = longitud;
    initMapForm({ lat: Number(latitud), lng: Number(longitud) });
    addMarker({ lat: Number(latitud), lng: Number(longitud) },nombre_restaurante);
}

function actualizarFoto(el) {
    if (el.target.files && el.target.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            divFoto.innerHTML = `<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;">`;
        };
        reader.readAsDataURL(el.target.files[0]);
        span.innerHTML = `${el.target.files[0].name}`;

    }
}

function limpiarForm(op) {
    form.reset();
    document.querySelector("#idrestaurante").value = "0";
    divFoto.innerHTML = "";
    span.innerHTML = "Haz click para seleccionar foto";
    if (op) {
        document.querySelector("#nombre").removeAttribute("required");
    } else {
        document.querySelector("#nombre").setAttribute("required", "true");
    }
}

function crearTabla() {
    initMapTabla();
    //Filtro para buscar
    if (objDatos.filter === "") {
        objDatos.recordsFilter = objDatos.records.map(item => item);


    } else {
        objDatos.recordsFilter = objDatos.records.filter(item => {
            const { nombre_restaurante, direccion, contacto } = item;
            if ((nombre_restaurante.toLowerCase().search(objDatos.filter.toLowerCase()) != -1) ||
                (direccion.toLowerCase().search(objDatos.filter.toLowerCase()) != -1) ||
                (contacto.toLowerCase().search(objDatos.filter.toLowerCase()) != -1)) {
                return item;
            }
        });
    }
    const recordIni = (objDatos.currentPage * recordShow) - recordShow;
    const recordFin = (recordIni + recordShow) - 1;

    let html = "";
    objDatos.recordsFilter.forEach((item, index) => {
        //Se borran los marcadores que existen para poner los filtrados
        objDatos.markers.splice(0, objDatos.markers.length);
        objDatos.markers.push({ lat: item["latitud"], lng: item["longitud"] });
        //Se envian los datos para que aparezcan en el mapa
        addMarker({ lat: Number(item["latitud"]), lng: Number(item["longitud"])},item["nombre_restaurante"] );

        //Se crea la tabla con los datos paginados
        if ((index >= recordIni) && (index <= recordFin)) {
            const { nombre_restaurante, direccion, telefono, contacto, fecha_ingreso } = item;
            let fecha = fecha_ingreso.split(" ");
            fecha = fecha[0].replaceAll("-", "/");
            html += `<tr>
              <td scope="col">${index + 1}</td>
              <td scope="col">${nombre_restaurante}</td>
              <td scope="col">${direccion}</td>
              <td scope="col">${telefono}</td>
              <td scope="col">${contacto}</td>
              <td scope="col">${fecha}</td>
              <td scope="col">
                <button class="btn btn-primary btn-xs" onclick="editarRestaurante(${item.idrestaurante})">
                <i class="far fa-edit"></i></button>
                <button class="btn btn-danger btn-xs" onclick="eliminarRestaurante(${item.idrestaurante})">
                <i class="fas fa-trash-alt"></i></button></td>
              </tr>
        `;
        }
    });

    tableContent.innerHTML = html;
    paginacion();

}

function paginacion() {
    while (pagination.firstElementChild) {
        pagination.removeChild(pagination.firstElementChild);
    }
    const anterior = document.createElement("li");
    anterior.classList.add("page-item");
    anterior.innerHTML = `<a class="page-link" href="#">&laquo;</a>`;
    anterior.onclick = () => {
        objDatos.currentPage = (objDatos.currentPage == 1 ? 1 : --objDatos.currentPage);
        crearTabla();
    }
    pagination.append(anterior);
    const totalPage = Math.ceil(objDatos.recordsFilter.length / recordShow);
    for (let i = 1; i <= totalPage; i++) {
        const el = document.createElement("li");
        el.classList.add("page-item");
        if (objDatos.currentPage == i) {
            el.classList.add("active");
        }
        el.innerHTML = `<a class="page-link" href="#">${i}</a>`;
        el.onclick = () => {
            objDatos.currentPage = i;
            crearTabla();
        }
        pagination.append(el);
    }
    const siguiente = document.createElement("li");
    siguiente.classList.add("page-item");
    siguiente.innerHTML = `<a class="page-link" href="#">&raquo;</a>`;
    siguiente.onclick = () => {
        objDatos.currentPage = (objDatos.currentPage == totalPage ? totalPage : ++objDatos.currentPage);
        crearTabla();
    }
    pagination.append(siguiente);
}

function filtro(e) {
    e.preventDefault();
    objDatos.filter = this.value;
    crearTabla();
}

//Iniciar el mapa de la tabla de restaurantes
function initMapTabla() {
    const center = { lat: 13.977401002393075, lng: -89.56200214651783 };
    map = new google.maps.Map(document.getElementById("mapTabla"), {
        center: center,
        zoom: 10,
        streetViewControl: false,
    });
}

//Iniciar el mapa del formulario de restaurantes
function initMapForm(center = { lat: 13.977401002393075, lng: -89.56200214651783 }) {

    map = new google.maps.Map(document.getElementById("mapForm"), {
        center: center,
        zoom: 10,
        streetViewControl: false,
    });

    // Agrega un evento click al mapa
    map.addListener("click", function (e) {
        //Obtiene las coordenadas del click
        var lat = e.latLng.lat();
        var lng = e.latLng.lng();
        //Se setean a los inputs
        document.querySelector("#lat").value = lat;
        document.querySelector("#lon").value = lng;
        //Borramos el marker si es que existe
        if (marker) {
            marker.setMap(null);
        }
        //Añadimos el marker
        marker = new google.maps.Marker({
            position: { lat: lat, lng: lng },
            map: map,
        });
    });
}

//Agregar un marker
function addMarker(LatLng, title = "") {
    if (title == "") {
        marker = new google.maps.Marker({
            position: { lat: LatLng["lat"], lng: LatLng["lng"] },
            map: map,
        });
    }else{
        marker = new google.maps.Marker({
            position: { lat: LatLng["lat"], lng: LatLng["lng"] },
            map: map,
            title: title
        });
    }

}