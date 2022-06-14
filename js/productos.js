// @Import 
import { agregar, editar, cargar, eliminar, cargarTodos } from './productos.operaciones'
import { cargarTodos as cargarCategorias } from './categorias.operaciones'

// @Componentes BS5 
const modalGuardarEl = document.getElementById('modalGuardar')
const modalGuardar = new bootstrap.Modal(modalGuardarEl)
const modalDetalle = new bootstrap.Modal('#modalDetalle')

// Elementos necesarios
const form = document.getElementById('form')
const productos = document.getElementById('productos')


// Ejecutar funciones al cargar la pagina:
mostrarProductos()
mostrarCategorias()

// @Eventos
modalGuardarEl.addEventListener('show.bs.modal', () => {
    modalGuardarEl.querySelector('.modal-title').textContent = 'Nuevo producto'
})

modalGuardarEl.addEventListener('shown.bs.modal', () => document.getElementById('nombre').focus())
modalGuardarEl.addEventListener('hidden.bs.modal', () => form.reset())

form.addEventListener('submit', event => {
    event.preventDefault()

    if (!validaciones())
        return false;

    const data = getFormData()
    guardarProducto(data)
})

// @Funciones
function mostrarProductos() {
    cargarTodos()
        .then(data => renderFilas(data))
        .catch(error => console.log(error))
}

function mostrarCategorias() {
    cargarCategorias()
        .then(data => renderCategoriasOptions(data))
        .catch(error => console.log(error))
}

function guardarProducto(data) {
    if (data.id == '') {
        agregar(data)
            .then(data => {
                modalGuardar.hide()
                showDetalleModal(data)
                mostrarProductos()
            })
            .catch((error) => console.log(error))
    } else {
        editar(data)
            .then(data => {
                modalGuardar.hide()
                showDetalleModal(data)
                mostrarProductos()
            })
            .catch((error) => console.log(error))
    }

}

function renderFilas(data) {

    const rows = data.map((d, index) => {

        return `<tr>` +
            `<td> ${index + 1} </td>` +
            `<td>
                <a href="#" class="text-decoration-none btn-show" data-id="${d.id}">${d.nombre}</a>
             </td>` +
            `<td> ${d.precio} </td>` +
            `<td> ${d.stock} </td>` +
            `<td> ${d.categoria} </td>` +
            `<td> ${d.fecha_ingreso} </td>` +
            `<td> ${d.fecha_modificacion}</td>` +
            `<td>
                <button type="button" class="btn btn-danger btn-sm me-1 btn-delete" data-id="${d.id}">
                    <i class="bi bi-x"></i>
                </button>
                <button type="button" class="btn btn-primary btn-sm btn-edit" data-id="${d.id}">
                    <i class="bi bi-pencil-fill"></i>
                </button>
            </td>` +
            `</tr>`
    })

    productos.innerHTML = rows.join('')

    document.querySelectorAll('a.btn-show').forEach((btn) => {
        btn.addEventListener('click', (e) => {

            const params = { id: btn.dataset.id }
            cargar(params)
                .then(data => showDetalleModal(data))
                .catch(error => console.log(error))
        })
    })

    document.querySelectorAll('button.btn-delete').forEach((btn) => {
        btn.addEventListener('click', (e) => {

            if (!confirm('¿Estas seguro(a)?'))
                return false;

            const params = { id: btn.dataset.id }
            eliminar(params)
                .then(data => mostrarProductos())
                .catch(error => console.log(error))
        })
    })

    document.querySelectorAll('button.btn-edit').forEach((btn) => {
        btn.addEventListener('click', (e) => {

            const params = { id: btn.dataset.id }
            cargar(params)
                .then(data => setFormData(data))
                .catch(error => console.log(error))
        })
    })
}

function renderCategoriasOptions(data) {

    const options = data.map((d, index) => {
        return `<option value="${d.id}"> ${d.nombre}</option>`
    })

    document.getElementById('categoria').innerHTML += options.join('')
}

function showDetalleModal(data) {
    modalDetalle.show()
    document.getElementById('_nombre').textContent = data.nombre
    document.getElementById('_stock').textContent = data.stock
    document.getElementById('_precio').textContent = data.precio
    document.getElementById('_categoria').textContent = data.categoria
    document.getElementById('_descripcion').textContent = data.descripcion
    document.getElementById('_fecha_ingreso').textContent = data.fecha_ingreso
    document.getElementById('_fecha_modificacion').textContent = data.fecha_modificacion
}

function setFormData(data) {
    modalGuardar.show()
    modalGuardarEl.querySelector('.modal-title').textContent = 'Editar producto'
    document.getElementById('id').value = data.id
    document.getElementById('nombre').value = data.nombre
    document.getElementById('precio').value = data.precio
    document.getElementById('stock').value = data.stock
    document.getElementById('categoria').value = data.categoria
    document.getElementById('descripcion').value = data.descripcion
}

function getFormData() {
    return {
        id: document.getElementById('id').value,
        nombre: document.getElementById('nombre').value,
        precio: document.getElementById('precio').value,
        stock: document.getElementById('stock').value,
        descripcion: document.getElementById('descripcion').value,
        categoria_id: document.getElementById('categoria').value
    }
}

function validaciones() {
    return true;
}
