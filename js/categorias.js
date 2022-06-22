// @Imports 
import { agregar, editar, cargar, eliminar, cargarTodos } from './servicios/categorias.operaciones'
import { estaVacio } from './validaciones'
import { dt_language_options } from './servicios/constants'

// @Componentes BS5 
const modalGuardarEl = document.getElementById('modalGuardar')
const modalGuardar = new bootstrap.Modal(modalGuardarEl)

const modalDetalleEl = document.getElementById('modalDetalle')
const modalDetalle = new bootstrap.Modal(modalDetalleEl)

// Elementos necesarios
const _errores = document.getElementById('errores')
const form = document.getElementById('form')
const _id = document.getElementById('id')
const _nombre = document.getElementById('nombre')
const _descripcion = document.getElementById('descripcion')

// Ejecutar funciones al cargar la pagina:
// @Funciones
function mostrarElemento(data) {
    showModalDetalles(data)
}

function editarElemento(data) {
    showModalEditar(data)
}

function eliminarElemento(data) {

    if (!confirm('¿Estas seguro(a)?'))
        return false;

    eliminar(data)
        .then(data => table.ajax.reload())
        .catch(error => console.log(error))
}

function guardarElemento(data) {

    if (data.id === '')
        agregar(data)
            .then(data => {
                showModalDetalles(data)
                table.ajax.reload()
            })
            .catch((error) => console.log(error))
    else
        editar(data)
            .then(data => {
                showModalDetalles(data)
                table.ajax.reload()
            })
            .catch((error) => console.log(error))
}

function getFormData() {
    return {
        id: _id.value,
        nombre: _nombre.value,
        descripcion: _descripcion.value,
    }
}

function showModalEditar(data) {
    modalGuardar.show()
    modalGuardarEl.querySelector('.modal-title').textContent = 'Editar categoría'

    _id.value = data.id
    _nombre.value = data.nombre
    _descripcion.value = data.descripcion
}

function showModalDetalles(data) {
    modalGuardar.hide()
    modalDetalle.show()
    modalDetalleEl.querySelector('.id').textContent = data.id
    modalDetalleEl.querySelector('.nombre').textContent = data.nombre
    modalDetalleEl.querySelector('.descripcion').textContent = data.descripcion
    modalDetalleEl.querySelector('.fecha_ingreso').textContent = data.fecha_ingreso
    modalDetalleEl.querySelector('.fecha_modificacion').textContent = data.fecha_modificacion
}

function validaciones() {

    let valid = true
    let errores = []

    if (estaVacio(_nombre.value)) {
        errores.push(`Debe llenar el campo 'nombre'`)
        _nombre.classList.add('is-invalid')
        valid = false
    }

    if (estaVacio(_descripcion.value)) {
        errores.push(`Debe llenar el campo 'descripcion'`)
        _descripcion.classList.add('is-invalid')
        valid = false
    }

    _errores.innerHTML = errores.map(e => `<li>${e}</li>`).join('')

    if (!valid)
        modalGuardarEl.querySelector('.modal-error').classList.remove('d-none')

    return valid
}

// @Eventos
modalGuardarEl.addEventListener('show.bs.modal', () => {
    modalGuardarEl.querySelector('.modal-title').textContent = 'Nueva categoría'
    modalGuardarEl.querySelector('.modal-error').classList.add('d-none')
    _nombre.classList.remove('is-invalid')
    _descripcion.classList.remove('is-invalid')
})

modalGuardarEl.addEventListener('shown.bs.modal', () => _nombre.focus())
modalGuardarEl.addEventListener('hidden.bs.modal', () => form.reset())


form.addEventListener('submit', event => {
    event.preventDefault()

    if (!validaciones())
        return false;

    const data = getFormData()
    guardarElemento(data)
})

_nombre.addEventListener('keydown', () => {
    _nombre.classList.remove('is-invalid')
})

_descripcion.addEventListener('keydown', () => {
    _descripcion.classList.remove('is-invalid')
})

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
        { data: null, },
        { data: 'descripcion' },
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
            render: (data, type, row, meta) => {
                return `<a href="#" class="text-decoration-none btn-show" data-row="${meta.row}">${data.nombre}</a>`
            }
        },
        {
            targets: -1,
            render: (data, type, row, meta) => {
                return `<div>
                            <button class="btn btn-sm btn-danger btn-delete" data-row="${meta.row}">
                                <i class="bi bi-x icon-delete"></i>
                            </button>
                            <button class="btn btn-sm btn-primary btn-edit" data-row="${meta.row}">
                                <i class="bi bi-pencil-fill icon-edit"></i>
                            </button>
                        </div>`
            }
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