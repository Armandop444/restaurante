const BASE_API = '/restaurante/';

class Api {
    /**
    * Toma el formulario de login y envia los datos para validar el inicio de sesion.
    * @param form - Datos que se enviaran al servidor.
    * @returns Lista.
    */
    async validarLogin(form) {
        const query = await fetch(`${BASE_API}login/validar`, {
            method: "POST",
            body: form,
        });
        const data = await query.json();
        return data;
    }
    
    //USUARIOS
    /**
    * Carga los datos de Usuarios.
    * @returns Lista.
    */
    async loadUsers() {
        const query = await fetch(`${BASE_API}usuarios/getAll`);
        const data = await query.json();
        return data;
    }

    /**
    * Guarda los datos de un form de Usuario.
    * @param form - Formulario de guardar Usuario.
    * @returns Lista.
    */
    async saveUser(form) {
        const query = await fetch(`${BASE_API}usuarios/save`, {
            method: "POST",
            body: form,
        });
        const data = await query.json();
        return data;
    }

    /**
    * Obtiene los datos de un registro de Usuario.
    * @param id - id del usuario que se desea buscar.
    * @returns Lista.
    */
    async getOneUser(id){
        const query = await fetch(`${BASE_API}usuarios/getOneUser?id=${id}`);
        const data = await query.json();
        return data;
    }

    /**
    * Elimina un registro de usuario
    * @param id - id del usuario que se desea eliminar.
    * @returns Lista.
    */
    async deleteUser(id){
        const query = await fetch(`${BASE_API}usuarios/deleteUser?id=${id}`);
        const data = await query.json();
        return data;
    }

    //RESTAURANTES
    /**
    * Carga los datos de Restaurante.
    * @returns Lista.
    */
    async loadRestaurantes() {
        const query = await fetch(`${BASE_API}restaurantes/getAll`);
        const data = await query.json();
        return data;
    }

    /**
    * Guarda los datos de un form de Restaurante.
    * @param form - Formulario de guardar restaurante.
    * @returns Lista.
    */
    async saveRestaurante(form) {
        const query = await fetch(`${BASE_API}restaurantes/save`, {
            method: "POST",
            body: form,
        });
        const data = await query.json();
        return data;
    }

    /**
    * Obtiene los datos de un registro de Restaurante.
    * @param id - id del restaurante que se desea buscar.
    * @returns Lista.
    */
    async getOneRestaurante(id){
        const query = await fetch(`${BASE_API}restaurantes/getOneRestaurante?id=${id}`);
        const data = await query.json();
        return data;
    }

    /**
    * Elimina un registro de restaurante
    * @param id - id del restaurante que se desea eliminar.
    * @returns Lista.
    */
    async deleteRestaurante(id){
        const query = await fetch(`${BASE_API}restaurantes/deleteRestaurante?id=${id}`);
        const data = await query.json();
        return data;
    }

    //PRODUCTOS
    /**
    * Carga los datos de Productos.
    * @returns Lista.
    */
    async loadProductos() {
        const query = await fetch(`${BASE_API}productos/getAll`);
        const data = await query.json();
        return data;
    }

    /**
    * Guarda los datos de un form de Productos.
    * @param form - Formulario de guardar Producto.
    * @returns Lista.
    */
    async saveProducto(form) {
        const query = await fetch(`${BASE_API}productos/save`, {
            method: "POST",
            body: form,
        });
        const data = await query.json();
        return data;
    }
    /**
    * Obtiene los datos de un registro de producto.
    * @param id - id del producto que se desea buscar.
    * @returns Lista.
    */
    async getOneProducto(id){
        const query = await fetch(`${BASE_API}productos/getOneProducto?id=${id}`);
        const data = await query.json();
        return data;
    }

    /**
    * Elimina un registro de producto
    * @param id - id del producto que se desea eliminar.
    * @returns Lista.
    */
    async deleteProducto(id){
        const query = await fetch(`${BASE_API}productos/deleteProducto?id=${id}`);
        const data = await query.json();
        return data;
    }
    
    //INGREDIENTES
    /**
    * Carga los datos de Ingredientes.
    * @returns Lista.
    */
    async getIngredientesByProducto(id) {
        const query = await fetch(`${BASE_API}productos/getIngredientesByProducto?id=${id}`);
        const data = await query.json();
        return data;
    }
    /**
    * Guarda los datos de ingredientes
    * @param form Datos para de guardar ingrediente.
    * @returns Lista.
    */
    async saveIngrediente(form) {
        const query = await fetch(`${BASE_API}productos/saveIngrediente`, {
            method: "POST",
            body: form,
        });
        const data = await query.json();
        return data;
    }

    /**
    * Obtiene los datos de un registro de ingrediente.
    * @param id - id del ingrediente que se desea buscar.
    * @returns Lista.
    */
    async getOneIngrediente(id){
        const query = await fetch(`${BASE_API}productos/getOneIngrediente?id=${id}`);
        const data = await query.json();
        return data;
    }

    /**
    * Elimina un registro de ingrediente
    * @param id - id del ingrediente que se desea eliminar.
    * @returns Lista.
    */
    async deleteIngrediente(id){
        const query = await fetch(`${BASE_API}productos/deleteIngrediente?id=${id}`);
        const data = await query.json();
        return data;
    }

}