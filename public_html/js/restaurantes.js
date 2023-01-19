//Mando a buscar al btnAgegar para abrir el formulario
const btnNuevo = document.querySelector("#btnAgregar");
const tableContent = document.querySelector("#contentTable table tbody");
const panelDatosRestaurante = document.querySelector("#panelDatosRestaurante");
const panelFormularioRestaurante = document.querySelector("#panelFormularioRestaurante");
const mensaje = document.querySelector("#mensajeDatos");
const searchText = document.querySelector("#txtSearch");
const pagination = document.querySelector(".pagination");
const recordShow = 1;
const API = new Api();
const objDatos = {
    records: [],
    recordsFilter: [],
    currentPage: 1,
    filter: ""
};

eventListeners();

function eventListeners() {
    btnNuevo.addEventListener("click", agregarRestaurante);
    document.addEventListener("DOMContentLoaded", cargarDatos);
    searchText.addEventListener("input", filtro);
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

function agregarRestaurante() {
    panelDatosRestaurante.classList.add("d-none");
    panelFormularioRestaurante.classList.remove("d-none");
}

function editarRestaurante(id) {
    alert(id);
}

function eliminarRestaurante(id) {
    alert(id);
}

function crearTabla() {
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
    while (pagination.firstElementChild){
        pagination.removeChild(pagination.firstElementChild);
    }
    const anterior=document.createElement("li");
    anterior.classList.add("page-item");
    anterior.innerHTML=`<a class="page-link" href="#">&laquo;</a>`;
    anterior.onclick=()=>{
        objDatos.currentPage=(objDatos.currentPage==1 ? 1: --objDatos.currentPage);
        crearTabla();
    }
    pagination.append(anterior);
    const totalPage=Math.ceil(objDatos.recordsFilter.length/recordShow);
    for (let i = 1; i <= totalPage; i++) {
        const el=document.createElement("li");
        el.classList.add("page-item");
        if (objDatos.currentPage==i) {
            el.classList.add("active");
        }
        el.innerHTML=`<a class="page-link" href="#">${i}</a>`;
        el.onclick=()=>{
            objDatos.currentPage=i;
            crearTabla();
        }
        pagination.append(el);
    }
    const siguiente=document.createElement("li");
    siguiente.classList.add("page-item");
    siguiente.innerHTML=`<a class="page-link" href="#">&raquo;</a>`;
    siguiente.onclick=()=>{
        objDatos.currentPage=(objDatos.currentPage==totalPage ? totalPage: ++objDatos.currentPage);
        crearTabla();
    }
    pagination.append(siguiente);
}

function filtro(e) {
    e.preventDefault();
    objDatos.filter = this.value;
    crearTabla();
}