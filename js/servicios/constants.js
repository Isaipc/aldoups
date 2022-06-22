const ROOT_URL = 'http://testeo.test'
const categorias_url = `${ROOT_URL}/categorias`
const productos_url = `${ROOT_URL}/productos`
const ventas_url = `${ROOT_URL}/ventas`
const cortes_de_caja_url = `${ROOT_URL}/cortes-de-caja`
const reportes_url = `${ROOT_URL}/reportes`

const dt_language_options = {
    emptyTable: "No hay datos disponibles",
    zeroRecords: "No se encontraron resultados",
    infoFiltered: "(filtrado de _MAX_ registros totales)",
    infoEmpty: "Mostrando 0 registros",
    search: 'Buscar',
    info: "Mostrando pagina _PAGE_ de _PAGES_",
    paginate: {
        first: "Primero",
        last: "Ultimo",
        next: "Siguiente",
        previous: "Anterior"
    },
    lengthMenu: "Mostrar _MENU_ filas",
    processing: 'Procesando ...'
};


export {
    categorias_url,
    productos_url,
    ventas_url,
    cortes_de_caja_url,
    reportes_url,
    ROOT_URL,
    dt_language_options
}