// @Imports 
import { categorias_url } from './common'

// @Componentes BS5 
const modalOptions = {
    keyboard: true
}
const modalIngresar = new bootstrap.Modal('#modalIngresar', modalOptions)
const modalDetalle = new bootstrap.Modal('#modalDetalle', modalOptions)

// Elementos necesarios
const form = document.getElementById('form')
const categorias = document.getElementById('categorias')


// Ejecutar funciones al cargar la pagina:
cargarTodos()

// @Eventos
form.addEventListener('submit', function (e) {
    e.preventDefault()

    const url = `${categorias_url}/agregar`
    const data = {
        nombre: document.getElementById('nombre').value,
        descripcion: document.getElementById('descripcion').value,
    }

    if (!validaciones())
        return false;

    agregar(url, data)
        .then(data => {
            modalIngresar.hide()
            modalDetalle.show()

            showDetalleModal(data)
            cargarTodos()
        })
        .catch((error) => console.log(error))
})


// @Funciones
async function agregar(url, data) {

    const response = await fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    return response.json()
}

function cargarTodos() {
    const url = `${categorias_url}/list`

    fetch(url, {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' }
    })
        .then(response => response.json())
        .then(data => renderFilas(data))
        .catch(error => console.log(error))
}

function renderFilas(data) {

    const rows = data.map((d, index) => {

        return `<tr>` +
            `<td> ${index + 1} </td>` +
            `<td> ${d.nombre} </td>` +
            `<td> ${d.descripcion} </td>` +
            `<td> ${d.fecha_ingreso} </td>` +
            `<td> ${d.fecha_modificacion}</td>` +
            `</tr >`
    })

    categorias.innerHTML = rows.join('')
}

function showDetalleModal(data) {
    document.getElementById('_nombre').textContent = data.nombre
    document.getElementById('_descripcion').textContent = data.descripcion
    document.getElementById('_fecha_ingreso').textContent = data.fecha_ingreso
    document.getElementById('_fecha_modificacion').textContent = data.fecha_modificacion
}

function validaciones() {
    return true;
}
