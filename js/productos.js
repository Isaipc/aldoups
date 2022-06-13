// @Import 
import { productos_url } from "./common"
import { categorias_url } from "./common"

// @Componentes BS5 
const modalOptions = {
    keyboard: true
}
const modalIngresar = new bootstrap.Modal('#modalIngresar', modalOptions)
const modalDetalle = new bootstrap.Modal('#modalDetalle', modalOptions)

// Elementos necesarios
const form = document.getElementById('form')
const productos = document.getElementById('productos')


// Ejecutar funciones al cargar la pagina:
cargarProductos()
cargarCategorias()

// @Eventos
form.addEventListener('submit', function (e) {
    e.preventDefault()

    const url = `${productos_url}/agregar`
    const data = {
        nombre: document.getElementById('nombre').value,
        precio: document.getElementById('precio').value,
        stock: document.getElementById('stock').value,
        descripcion: document.getElementById('descripcion').value,
        categoria_id: document.getElementById('categoria').value
    }

    if (!validaciones())
        return false;

    agregar(url, data)
        .then(data => {
            modalIngresar.hide()
            modalDetalle.show()

            showDetalleModal(data)
            cargarProductos()
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

function cargarProductos() {
    const url = `${productos_url}/list`

    fetch(url, {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' }
    })
        .then(response => response.json())
        .then(data => renderFilas(data))
        .catch(error => console.log(error))
}

function cargarCategorias() {
    const url = `${categorias_url}/list`

    fetch(url, {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' }
    })
        .then(response => response.json())
        .then(data => renderCategoriasOptions(data))
        .catch(error => console.log(error))

}

function renderFilas(data) {

    const rows = data.map((d, index) => {

        return `<tr>` +
            `<td> ${index + 1} </td>` +
            `<td> ${d.nombre} </td>` +
            `<td> ${d.precio} </td>` +
            `<td> ${d.stock} </td>` +
            `<td> ${d.categoria} </td>` +
            `<td> ${d.fecha_ingreso} </td>` +
            `<td> ${d.fecha_modificacion}</td>` +
            `</tr>`
    })

    productos.innerHTML = rows.join('')
}

function showDetalleModal(data) {
    document.getElementById('_nombre').textContent = data.nombre
    document.getElementById('_precio').textContent = data.precio
    document.getElementById('_stock').textContent = data.stock
    document.getElementById('_descripcion').textContent = data.descripcion
    document.getElementById('_categoria').textContent = data.categoria
    document.getElementById('_fecha_ingreso').textContent = data.fecha_ingreso
    document.getElementById('_fecha_modificacion').textContent = data.fecha_modificacion
}

function renderCategoriasOptions(data) {
    const categorias = document.getElementById('categoria')

    const options = data.map((d, index) => {
        return `<option value="${d.id}">${d.nombre}</option>`
    })

    categorias.innerHTML += options.join('')
}

function validaciones() {
    return true;
}
