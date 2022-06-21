// @Imports 
import { agregar, editar, cargar, eliminar, cargarTodos } from './servicios/categorias.operaciones'
import { estaVacio } from './validaciones'

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
mostrarTodos()

// @Funciones
function mostrarTodos() {
    cargarTodos()
        .then(data => renderFilas(data))
        .catch(error => console.log(error))
}

function mostrarElemento(id) {

    const data = { id: id }

    cargar(data)
        .then(data => showModalDetalles(data))
        .catch(error => console.log(error))
}

function editarElemento(id) {

    const data = { id: id }

    cargar(data)
        .then(data => showModalEditar(data))
        .catch(error => console.log(error))
}

function eliminarElemento(id) {

    if (!confirm('¿Estas seguro(a)?'))
        return false;

    const data = { id: id }

    eliminar(data)
        .then(data => mostrarTodos())
        .catch(error => console.log(error))
}

function guardarElemento(data) {

    if (data.id === '')
        agregar(data)
            .then(data => {
                showModalDetalles(data)
                mostrarTodos()
            })
            .catch((error) => console.log(error))
    else
        editar(data)
            .then(data => {
                showModalDetalles(data)
                mostrarTodos()
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

function renderFilas(data) {

    document.getElementById('categorias').innerHTML = ''

    data.forEach((d, index) => {
        const fila =
            `<tr>` +
            `<td> ${index + 1} </td>` +
            `<td> <a href="#" class="text-decoration-none btn-show" data-id="${d.id}">${d.nombre}</a></td>` +
            `<td> ${d.descripcion} </td>` +
            `<td> ${d.fecha_ingreso} </td>` +
            `<td> ${d.fecha_modificacion}</td>` +
            `<td>
                <button class="btn btn-danger btn-sm me-1 btn-delete" data-id="${d.id}">
                    <i class="bi bi-x"></i>
                </button>
                <button class="btn btn-primary btn-sm btn-edit" data-id="${d.id}">
                    <i class="bi bi-pencil-fill"></i>
                </button>
            </td>` +
            `</tr>`

        document.getElementById('categorias').insertAdjacentHTML('beforeend', fila)
    })

    document.querySelectorAll('.btn-show').forEach((btn) => {
        btn.addEventListener('click', event => mostrarElemento(btn.dataset.id))
    })

    document.querySelectorAll('.btn-delete').forEach((btn) => {
        btn.addEventListener('click', event => eliminarElemento(btn.dataset.id))
    })

    document.querySelectorAll('.btn-edit').forEach((btn) => {
        btn.addEventListener('click', event => editarElemento(btn.dataset.id))
    })
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