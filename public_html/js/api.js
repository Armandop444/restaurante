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
    * @param form - Formulario de guardar restaurante
    */
    async saveRestaurante(form) {
        const query = await fetch(`${BASE_API}restaurantes/save`, {
            method: "POST",
            body: form,
        });
        const data = await query.json();
        return data;
    }

    async getOneRestaurante(id){
        const query = await fetch(`${BASE_API}restaurantes/getOneRestaurante?id=${id}`);
        const data = await query.json();
        return data;
    }
}