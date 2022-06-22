// @Import 
import { agregar, editar, cargar, eliminar, cargarTodos } from './servicios/productos.operaciones'
import { cargarTodos as cargarCategorias } from './servicios/categorias.operaciones'
import { estaVacio, esNumeroPositivo } from './validaciones'
import { dt_language_options, productos_url as _url } from './servicios/constants'

// @Componentes BS5 
const modalGuardarEl = document.getElementById('modalGuardar')
const modalGuardar = new bootstrap.Modal(modalGuardarEl)
const modalDetalle = new bootstrap.Modal('#modalDetalle')

// Elementos necesarios
const _form = document.getElementById('form')
const _errores = document.getElementById('errores')
const _id = document.getElementById('id')
const _nombre = document.getElementById('nombre')
const _precio = document.getElementById('precio')
const _stock = document.getElementById('stock')
const _descripcion = document.getElementById('descripcion')
const _categoria = document.getElementById('categoria')

// Ejecutar funciones al cargar la pagina:
mostrarCategorias()

// @Funciones
function mostrarElemento(data) {
    cargar(data)
        .then(data => showModalDetalles(data))
        .catch(error => console.log(error))
}

function editarElemento(data) {
    cargar(data)
        .then(data => showModalEditar(data))
        .catch(error => console.log(error))
}

function eliminarElemento(data) {

    if (!confirm('¿Estas seguro(a)?'))
        return false;

    eliminar(data)
        .then(data => table.ajax.reload())
        .catch(error => console.log(error))
}

function mostrarCategorias() {
    cargarCategorias()
        .then(data => renderCategoriasOptions(data.data))
        .catch(error => console.log(error))
}

function guardarProducto(data) {
    if (data.id == '') {
        agregar(data)
            .then(data => {
                showDetalleModal(data)
                table.ajax.reload()
            })
            .catch((error) => console.log(error))
    } else {
        editar(data)
            .then(data => {
                showDetalleModal(data)
                table.ajax.reload()
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

function showModalEditar(data) {
    modalGuardar.show()
    modalGuardarEl.querySelector('.modal-title').textContent = 'Editar producto'

    _id.value = data.id
    _nombre.value = data.nombre
    _precio.value = data.precio
    _stock.value = data.stock
    _categoria.value = data.categoria_id
    _descripcion.value = data.descripcion
}

function showModalDetalles(data) {
    modalGuardar.hide()
    modalDetalle.show()
    document.querySelector('.id').textContent = data.id
    document.querySelector('.nombre').textContent = data.nombre
    document.querySelector('.stock').textContent = data.stock
    document.querySelector('.precio').textContent = data.precio
    document.querySelector('.categoria').textContent = data.categoria
    document.querySelector('.descripcion').textContent = data.descripcion
    document.querySelector('.fecha_ingreso').textContent = data.fecha_ingreso
    document.querySelector('.fecha_modificacion').textContent = data.fecha_modificacion
}

function validaciones() {

    let valid = true
    let errores = []

    if (estaVacio(_nombre.value)) {
        errores.push(`Debe llenar el campo 'nombre'`)
        _nombre.classList.add('is-invalid')
        valid = false
    }

    if (estaVacio(_stock.value)) {
        errores.push(`Debe llenar el campo 'stock'`)
        _stock.classList.add('is-invalid')
        valid = false
    }

    if (!esNumeroPositivo(_stock.value)) {
        errores.push(`El campo 'stock' solo puede tener valor numerico positivo`)
        _stock.classList.add('is-invalid')
        valid = false
    }

    if (estaVacio(_precio.value)) {
        errores.push(`Debe llenar el campo 'precio'`)
        _precio.classList.add('is-invalid')
        valid = false
    }

    if (!esNumeroPositivo(_precio.value)) {
        errores.push(`El campo 'precio' solo puede tener valor numerico positivo`)
        _precio.classList.add('is-invalid')
        valid = false
    }

    if (estaVacio(_descripcion.value)) {
        errores.push(`Debe llenar el campo 'descripcion'`)
        _descripcion.classList.add('is-invalid')
        valid = false
    }

    if (estaVacio(_categoria.value)) {
        errores.push(`Debe seleccionar 'categoria'`)
        _categoria.classList.add('is-invalid')
        valid = false
    }

    _errores.innerHTML = errores.map(e => `<li>${e}</li>`).join('')
    if (!valid)
        modalGuardarEl.querySelector('.modal-error').classList.remove('d-none')

    return valid
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
    modalGuardarEl.querySelector('.modal-error').classList.add('d-none')
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

_nombre.addEventListener('keydown', () => _nombre.classList.remove('is-invalid'))
_precio.addEventListener('keydown', () => _precio.classList.remove('is-invalid'))
_stock.addEventListener('keydown', () => _stock.classList.remove('is-invalid'))
_descripcion.addEventListener('keydown', () => _descripcion.classList.remove('is-invalid'))
_categoria.addEventListener('change', () => _categoria.classList.remove('is-invalid'))

let table = new DataTable('#datatable', {
    language: dt_language_options,
    paginate: false,
    info: false,
    search: {
        return: true
    },
    ajax: (d, cb) => {
        cargarTodos()
            .then(data => cb(data))
            .catch(error => console.log(error))
    },
    columns: [
        { data: null },
        { data: null },
        { data: 'precio' },
        { data: 'stock' },
        { data: 'categoria' },
        { data: 'fecha_ingreso' },
        { data: 'fecha_modificacion' },
        { data: null },
    ],
    columnDefs: [
        {
            targets: 0,
            render: (data, type, row, meta) => meta.row + 1
        },
        {
            targets: 1,
            render: (data, type, row, meta) =>
                `<a href="#" class="text-decoration-none btn-show" data-row="${meta.row}">${data.nombre}</a>`
        },
        {
            targets: -1,
            render: (data, type, row, meta) =>
                `<div>
                    <button class="btn btn-sm btn-danger btn-delete" data-row="${meta.row}">
                        <i class="bi bi-x icon-delete"></i>
                    </button>
                    <button class="btn btn-sm btn-primary btn-edit" data-row="${meta.row}">
                        <i class="bi bi-pencil-fill icon-edit"></i>
                    </button>
                </div>`
        }
    ]
})

document.addEventListener('click', event => {
    let target = event.target

    if (event.target.classList.contains('icon-delete') || event.target.classList.contains('icon-edit'))
        target = event.target.parentNode

    const row = target.dataset.row
    const data = table.row(row).data()

    if (target.classList.contains('btn-delete'))
        eliminarElemento(data)
    else if (target.classList.contains('btn-edit'))
        editarElemento(data)
    else if (target.classList.contains('btn-show'))
        mostrarElemento(data)
})