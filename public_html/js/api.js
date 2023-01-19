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
}