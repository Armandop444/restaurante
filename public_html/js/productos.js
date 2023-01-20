//Mando a buscar al btnAgegar para abrir el formulario
const btnNuevo = document.querySelector("#btnAgregar");
const tableContent = document.querySelector("#contentTable table tbody");
const panelDatosProductos = document.querySelector("#panelDatosProductos");
const panelFormularioProductos = document.querySelector("#panelFormularioProductos");
const mensaje = document.querySelector("#mensajeDatos");
const searchText = document.querySelector("#txtSearch");
const pagination = document.querySelector(".pagination");
const btnCancelar = document.querySelector("#btnCancelar");
const divFoto = document.querySelector("#divFoto");
const divFoto2 = document.querySelector("#divFoto2");
const divFoto3 = document.querySelector("#divFoto3");
const inputFoto = document.querySelector("#foto");
const inputFoto2 = document.querySelector("#foto2");
const inputFoto3 = document.querySelector("#foto3");
const span = document.querySelector("#spanClick");
const span2 = document.querySelector("#spanClick2");
const span3 = document.querySelector("#spanClick3");
const form = document.querySelector("#form");
const nombreR = document.querySelector("#nombreR");
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
    btnNuevo.addEventListener("click", agregarProducto);
    document.addEventListener("DOMContentLoaded", cargarDatos);
    searchText.addEventListener("input", filtro);
    btnCancelar.addEventListener("click", cancelarProducto);
    divFoto.addEventListener("click", agregarFoto);
    divFoto2.addEventListener("click", agregarFoto2);
    divFoto3.addEventListener("click", agregarFoto3);
    inputFoto.addEventListener("change", actualizarFoto);
    inputFoto2.addEventListener("change", actualizarFoto2);
    inputFoto3.addEventListener("change", actualizarFoto3);
    form.addEventListener("submit", guardarProducto);
}

function cargarDatos() {
    // console.log("Datos Cargados");
    API.loadProductos().then(data => {
        if (data.success) {
            objDatos.records = data.records;
            objDatos.currentPage = 1;
            crearTabla();
            API.loadRestaurantes().then(data => {
                if (data.success){
                    optionsRestaurante(data.records);
                }
            });
        } else {
            mensaje.textContent = data.msg;
        }
    }).catch(error => {
        console.error("Error: ", error);
    });

}

function optionsRestaurante(records) {
    nombreR.innerHTML = "";
    nombreR.innerHTML ="<option value='0' selected>Seleccione Restaurante</option>"
    records.forEach(item => {
        const { idrestaurante, nombre_restaurante } = item;
        const option = document.createElement("option");
        option.value = idrestaurante;
        option.textContent = nombre_restaurante;
        nombreR.append(option);

    });
}

//agregar y cancelar muestran y ocultan los paneles de la tabla y formulario de crear
function agregarProducto() {
    panelDatosProductos.classList.add("d-none");
    panelFormularioProductos.classList.remove("d-none");
}

function cancelarProducto() {
    panelDatosProductos.classList.remove("d-none");
    panelFormularioProductos.classList.add("d-none");
    cargarDatos();
    limpiarForm();
}

// Guardar Producto
function guardarProducto(e) {
    e.preventDefault();
    const formData = new FormData(form);

    API.saveProducto(formData).then(data => {
        if (data.success) {
            cancelarProducto();
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
function editarProducto(id) {
    limpiarForm(1);
    panelDatosProductos.classList.add("d-none");
    panelFormularioProductos.classList.remove("d-none");
    API.getOneProducto(id).then(data => {
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

function eliminarProducto(id) {
    Swal.fire({
        title: "¿Desea eliminar el registro?",
        showDenyButton: true,
        confirmButtonText: "Si",
        denyButtonText: "No"
    }).then(result => {
        if (result.isConfirmed) {
            API.deleteProducto(id).then(data => {
                if (data.success) {
                    cancelarProducto();
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
function agregarFoto2() {
    inputFoto2.click();
}
function agregarFoto3() {
    inputFoto3.click();
}

function mostrarDatosForm(record) {
    
    const { idproducto, idrestaurante,nombre, descripcion, precio, foto1, foto2, foto3 } = record;
    document.querySelector("#idproducto").value = idproducto;
    document.querySelector("#nombre").value = nombre;
    document.querySelector("#descripcion").value = descripcion;
    document.querySelector("#precio").value = precio;
    nombreR.value=idrestaurante
    divFoto.innerHTML = `<img src="${foto1}" class="h-100 w-100" style="object-fit:contain;">`;
    divFoto2.innerHTML = `<img src="${foto2}" class="h-100 w-100" style="object-fit:contain;">`;
    divFoto3.innerHTML = `<img src="${foto3}" class="h-100 w-100" style="object-fit:contain;">`;
    
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

function actualizarFoto2(el) {
    if (el.target.files && el.target.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            divFoto2.innerHTML = `<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;">`;
        };
        reader.readAsDataURL(el.target.files[0]);
        span2.innerHTML = `${el.target.files[0].name}`;

    }
}

function actualizarFoto3(el) {
    if (el.target.files && el.target.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            divFoto3.innerHTML = `<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;">`;
        };
        reader.readAsDataURL(el.target.files[0]);
        span3.innerHTML = `${el.target.files[0].name}`;

    }
}

function limpiarForm(op) {
    form.reset();
    document.querySelector("#idproducto").value = "0";
    divFoto.innerHTML = "";
    divFoto2.innerHTML = "";
    divFoto3.innerHTML = "";
    span.innerHTML = "Haz click para seleccionar foto";
    span2.innerHTML = "Haz click para seleccionar foto";
    span3.innerHTML = "Haz click para seleccionar foto";
}

function crearTabla() {
    //Filtro para buscar
    if (objDatos.filter === "") {
        objDatos.recordsFilter = objDatos.records.map(item => item);
    } else {
        objDatos.recordsFilter = objDatos.records.filter(item => {
            const { nombre, nombre_restaurante, descripcion, precio } = item;
            let precios=precio.split("$")[0];
            if ((nombre.toLowerCase().search(objDatos.filter.toLowerCase()) != -1) ||
                (nombre_restaurante.toLowerCase().search(objDatos.filter.toLowerCase()) != -1) ||
                (descripcion.toLowerCase().search(objDatos.filter.toLowerCase()) != -1) ||
                (precios.search(objDatos.filter.toLowerCase()) != -1)) {
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
            const { nombre, descripcion, precio, nombre_restaurante } = item;
            html += `<tr>
              <td scope="col">${index + 1}</td>
              <td scope="col">${nombre_restaurante}</td>
              <td scope="col">${nombre}</td>     
              <td scope="col">${descripcion}</td>
              <td scope="col">$${parseFloat(precio).toFixed(2)}</td>
              <td scope="col">
                <button class="btn btn-success btn-xs" onClick="AgregarIngrediente(${item.idproducto})" title="Agregar Ingrediente">
                <i class="fa-solid fa-spoon"></i></button>
                <button class="btn btn-primary btn-xs" onclick="editarProducto(${item.idproducto})" title="Editar Producto">
                <i class="far fa-edit"></i></button>
                <button class="btn btn-danger btn-xs" onclick="eliminarProducto(${item.idproducto}) " title="Eliminar Producto">
                <i class="fas fa-trash-alt"></i></button>
                </td>
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