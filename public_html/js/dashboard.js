const ctx = document.getElementById('pie');
const ctx2 = document.getElementById('barras');
const ctx3 = document.getElementById('donut');
const API = new Api();
// <block:setup:1>
const datos = {
    restaurantes: [],
    productos: [],
    ingredientes: []
};


cargarDatos();

function cargarDatos() {
    //console.log("Datos Cargados");
    API.loadRestaurantes().then(data => {
        if (data.success) {
            datos.restaurantes = data.records;
            API.loadProductos().then(data => {
                if (data.success) {
                    datos.productos = data.records;
                    API.loadIngredientes().then(data => {
                        if (data.success) {
                            datos.ingredientes = data.records;
                            bar();
                            pie();
                            donut();
                        } else {
                            mensaje.textContent = data.msg;
                        }
                    }).catch(error => {
                        console.error("Error: ", error);
                    });
                } else {
                    mensaje.textContent = data.msg;
                }
            }).catch(error => {
                console.error("Error: ", error);
            });
        } else {
            mensaje.textContent = data.msg;
        }
    }).catch(error => {
        console.error("Error: ", error);
    });

}

function bar() {
    const data2 = {
        labels: ['Restaurantes', 'Pedidos', 'Ingredientes'],
        datasets: [{
            label: "Todos los datos",
            data: [datos.restaurantes.length, datos.productos.length, datos.ingredientes.length],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
            ],
            borderWidth: 1
        }]
    };
    new Chart(ctx2, {
        type: 'bar',
        data: data2,
    });
}

function pie() {
    const data = {
        labels: [
            'Restaurantes',
            'Productos',
            'Ingredientes   '
        ],
        datasets: [{
            label: "Todos los datos",
            data: [datos.restaurantes.length, datos.productos.length, datos.ingredientes.length],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    new Chart(ctx, {
        type: 'pie',
        data: data,
    });
}


function donut() {
    const data = {
        labels: [
            'Restaurantes',
            'Productos',
            'Ingredientes   '
        ],
        datasets: [{
            label: "Todos los datos",
            data: [datos.restaurantes.length, datos.productos.length, datos.ingredientes.length],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    new Chart(ctx3, {
        type: 'doughnut',
        data: data,
    });
}
