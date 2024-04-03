const getComunidades = async () => {

    try {
        const response = await fetch('/getComunidades');
        const data = await response.json();

        return data.original;
    } catch (error) {
        console.error('Error al obtener el token CSRF:', error);
        throw error;
    }
}

const getMunicipio = async (codigo) => {

    try {
        const response = await fetch("/municipio/" + codigo);

        const data = await response.json();
        return data.original;
    } catch (error) {
        console.error('Error al obtener el token CSRF:', error);
        throw error;
    }
}

const autocomplete = async (string) => {

    try {

        const response = await fetch("/autocomplete/" + string);
        const data = await response.json();
        return data.original;

    } catch (error) {
        console.error('Error al obtener el token CSRF:', error);
        throw error;
    }
}
export { getComunidades, getMunicipio, autocomplete }