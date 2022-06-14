// @Imports 
import { agregar, editar, cargar, eliminar, cargarTodos } from './categorias.operaciones'

// @Componentes BS5 
const modalOptions = {
    keyboard: true
}
const modalIngresarEl = document.getElementById('modalIngresar')
const modalIngresar = new bootstrap.Modal(modalIngresarEl, modalOptions)
const modalDetalle = new bootstrap.Modal('#modalDetalle', modalOptions)

// Elementos necesarios
const form = document.getElementById('form')
const categorias = document.getElementById('categorias')

// Ejecutar funciones al cargar la pagina:
mostrarTodos()

// @Eventos
modalIngresarEl.addEventListener('show.bs.modal', event => {
    modalIngresarEl.querySelector('.modal-title').textContent = 'Nueva categoría'
    form.reset()
})

form.addEventListener('submit', event => {
    event.preventDefault()

    if (!validaciones())
        return false;

    const data = getFormData()
    guardar(data)
})

// @Funciones
function mostrarTodos() {
    cargarTodos()
        .then(data => renderFilas(data))
        .catch(error => console.log(error))
}

function guardar(data) {

    if (data.id === '') {

        agregar(data)
            .then(data => {
                modalIngresar.hide()
                setDetalles(data)
                mostrarTodos()
            })
            .catch((error) => console.log(error))

    } else {

        editar(data)
            .then(data => {
                modalIngresar.hide()
                setDetalles(data)
                mostrarTodos()
            })
            .catch((error) => console.log(error))
    }
}

function renderFilas(data) {

    const rows = data.map((d, index) => {

        return `<tr>` +
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
            `</tr >`
    })

    categorias.innerHTML = rows.join('')

    document.querySelectorAll('a.btn-show').forEach((btn) => {
        btn.addEventListener('click', (e) => {

            const params = { id: btn.dataset.id }
            cargar(params)
                .then(data => setDetalles(data))
                .catch(error => console.log(error))
        })
    })

    document.querySelectorAll('button.btn-delete').forEach((btn) => {
        btn.addEventListener('click', (e) => {

            if (!confirm('¿Estas seguro(a)?'))
                return false;

            const params = { id: btn.dataset.id }
            eliminar(params)
                .then(data => mostrarTodos())
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

function setDetalles(data) {
    modalDetalle.show()
    document.getElementById('_id').textContent = data.id
    document.getElementById('_nombre').textContent = data.nombre
    document.getElementById('_descripcion').textContent = data.descripcion
    document.getElementById('_fecha_ingreso').textContent = data.fecha_ingreso
    document.getElementById('_fecha_modificacion').textContent = data.fecha_modificacion
}

function getFormData() {
    return {
        id: document.getElementById('id').value,
        nombre: document.getElementById('nombre').value,
        descripcion: document.getElementById('descripcion').value,
    }
}

function setFormData(data) {
    modalIngresar.show()
    modalIngresarEl.querySelector('.modal-title').textContent = 'Editar categoría'
    document.getElementById('id').value = data.id
    document.getElementById('nombre').value = data.nombre
    document.getElementById('descripcion').value = data.descripcion
}

function validaciones() {
    return true;
}
