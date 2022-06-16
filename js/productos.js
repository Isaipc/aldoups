// @Import 
import { agregar, editar, cargar, eliminar, cargarTodos } from './servicios/productos.operaciones'
import { cargarTodos as cargarCategorias } from './servicios/categorias.operaciones'

// @Componentes BS5 
const modalGuardarEl = document.getElementById('modalGuardar')
const modalGuardar = new bootstrap.Modal(modalGuardarEl)
const modalDetalle = new bootstrap.Modal('#modalDetalle')

// Elementos necesarios
const _form = document.getElementById('form')
const _productos = document.getElementById('productos')
const _id = document.getElementById('id')
const _nombre = document.getElementById('nombre')
const _precio = document.getElementById('precio')
const _stock = document.getElementById('stock')
const _descripcion = document.getElementById('descripcion')
const _categoria = document.getElementById('categoria')

// Ejecutar funciones al cargar la pagina:
mostrarProductos()
mostrarCategorias()

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
                showDetalleModal(data)
                mostrarProductos()
            })
            .catch((error) => console.log(error))
    } else {
        editar(data)
            .then(data => {
                showDetalleModal(data)
                mostrarProductos()
            })
            .catch((error) => console.log(error))
    }
}

function getFormData() {
    return {
        id: _id.value,
        nombre: _nombre.value,
        precio: _precio.value,
        stock: _stock.value,
        descripcion: _descripcion.value,
        categoria_id: _categoria.value
    }
}

function setFormData(data) {
    modalGuardar.show()
    modalGuardarEl.querySelector('.modal-title').textContent = 'Editar producto'
    
    _id.value = data.id
    _nombre.value = data.nombre
    _precio.value = data.precio
    _stock.value = data.stock
    _categoria.value = data.categoria_id
    _descripcion.value = data.descripcion
}

function showDetalleModal(data) {
    modalGuardar.hide()
    modalDetalle.show()
    document.getElementById('_nombre').textContent = data.nombre
    document.getElementById('_stock').textContent = data.stock
    document.getElementById('_precio').textContent = data.precio
    document.getElementById('_categoria').textContent = data.categoria
    document.getElementById('_descripcion').textContent = data.descripcion
    document.getElementById('_fecha_ingreso').textContent = data.fecha_ingreso
    document.getElementById('_fecha_modificacion').textContent = data.fecha_modificacion
}

function validaciones() {
    return true;
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

    _productos.innerHTML = rows.join('')

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

// @Eventos
modalGuardarEl.addEventListener('show.bs.modal', () => {
    modalGuardarEl.querySelector('.modal-title').textContent = 'Nuevo producto'
})

modalGuardarEl.addEventListener('shown.bs.modal', () => document.getElementById('nombre').focus())
modalGuardarEl.addEventListener('hidden.bs.modal', () => _form.reset())

_form.addEventListener('submit', event => {
    event.preventDefault()

    if (!validaciones())
        return false;

    const data = getFormData()
    guardarProducto(data)
})