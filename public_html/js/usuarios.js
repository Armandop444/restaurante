//Mando a buscar al btnAgegar para abrir el formulario
const btnNuevo = document.querySelector("#btnAgregar");
const tableContent = document.querySelector("#contentTable table tbody");
const panelDatosUsuario = document.querySelector("#panelDatosUser");
const panelFormularioUsuario = document.querySelector("#panelFormularioUser");
const mensaje = document.querySelector("#mensajeDatos");
const searchText = document.querySelector("#txtSearch");
const pagination = document.querySelector(".pagination");
const btnCancelar = document.querySelector("#btnCancelar");
const divFoto = document.querySelector("#divFoto");
const inputFoto = document.querySelector("#foto");
const span = document.querySelector("#spanClick");
const form = document.querySelector("#form");
const recordShow = 6;
const API = new Api();
const objDatos = {
    records: [],
    recordsFilter: [],
    currentPage: 1,
    filter: ""
};

eventListeners();

function eventListeners() {
    btnNuevo.addEventListener("click", agregarUser);
    document.addEventListener("DOMContentLoaded", cargarDatos);
    searchText.addEventListener("input", filtro);
    btnCancelar.addEventListener("click", cancelarUser);
    divFoto.addEventListener("click", agregarFoto);
    inputFoto.addEventListener("change", actualizarFoto);
    form.addEventListener("submit", guardarUser);
}

function cargarDatos() {
    // console.log("Datos Cargados");
    API.loadUsers().then(data => {
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
function agregarUser() {
    panelDatosUsuario.classList.add("d-none");
    panelFormularioUsuario.classList.remove("d-none");
}

function cancelarUser() {
    panelDatosUsuario.classList.remove("d-none");
    panelFormularioUsuario.classList.add("d-none");
    cargarDatos();
    limpiarForm();
}

// Guardar Restaurante
function guardarUser(e) {
    e.preventDefault();
    const formData = new FormData(form);
    
    API.saveUser(formData).then(data => {
        if (data.success) {
            cancelarUser();
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
function editarUser(id) {
    limpiarForm(1);
    panelDatosUsuario.classList.add("d-none");
    panelFormularioUsuario.classList.remove("d-none");
    API.getOneUser(id).then(data => {
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

function eliminarUser(id) {
    Swal.fire({
        title: "¿Desea eliminar el registro?",
        showDenyButton: true,
        confirmButtonText: "Si",
        denyButtonText: "No"
    }).then(result => {
        if (result.isConfirmed) {
            API.deleteUser(id).then(data => {
                if (data.success) {
                    cancelarUser();
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
    const { id_usr, usuario, nombres, apellidos, tipo, foto} = record;
    document.querySelector("#id_usr").value = id_usr;
    document.querySelector("#user").value = usuario;
    document.querySelector("#nombres").value = nombres;
    document.querySelector("#apellidos").value = apellidos;
    document.querySelector("#tipo").value = tipo;
    divFoto.innerHTML = `<img src="${foto}" class="h-100 w-100" style="object-fit:contain;">`;
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
    document.querySelector("#id_usr").value = "0";
    divFoto.innerHTML = "";
    span.innerHTML = "Haz click para seleccionar foto";
    if (op) {
        document.querySelector("#pass").removeAttribute("required");
    } else {
        document.querySelector("#pass").setAttribute("required", "true");
    }
}

function crearTabla() {
    //Filtro para buscar
    if (objDatos.filter === "") {
        objDatos.recordsFilter = objDatos.records.map(item => item);
    } else {
        objDatos.recordsFilter = objDatos.records.filter(item => {
            const { usuario, nombres, apellidos, ntipo } = item;
            if ((usuario.toLowerCase().search(objDatos.filter.toLowerCase()) != -1) ||
                (nombres.toLowerCase().search(objDatos.filter.toLowerCase()) != -1) ||
                (apellidos.toLowerCase().search(objDatos.filter.toLowerCase()) != -1) ||
                (ntipo.toLowerCase().search(objDatos.filter.toLowerCase()) != -1)) {
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
            const { usuario, nombres, apellidos, ntipo } = item;
            html += `<tr>
              <td scope="col">${index + 1}</td>
              <td scope="col">${usuario}</td>
              <td scope="col">${nombres}</td>     
              <td scope="col">${apellidos}</td>
              <td scope="col">${ntipo}</td>
              <td scope="col">
                <button class="btn btn-primary btn-xs" onclick="editarUser(${item.id_usr})">
                <i class="far fa-edit"></i></button>
                <button class="btn btn-danger btn-xs" onclick="eliminarUser(${item.id_usr})">
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