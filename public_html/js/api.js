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
}