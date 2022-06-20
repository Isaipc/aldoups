// @Imports 
import { cargar, cargarTodos } from './servicios/ventas.operaciones'

//Elementos necesarios
const ventas = document.getElementById('items')

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
        .then(data => console.log(data))
        .catch(error => console.log(error))
}

function renderFilas(data) {

    ventas.innerHTML = ''

    data.forEach((d, index) => {
        const fila =
            `<tr>` +
            `<td> ${index + 1} </td>` +
            `<td> <a href="#" class="text-decoration-none btn-show" data-id="${d.id}">${d.id}</a></td>` +
            `<td> ${d.total} </td>` +
            `<td> ${d.fecha_ingreso} </td>` +
            `<td> </td>` +
            `</tr>`

        ventas.insertAdjacentHTML('beforeend', fila)
    })

    document.querySelectorAll('.btn-show').forEach((btn) => {
        btn.addEventListener('click', event => mostrarElemento(btn.dataset.id))
    })
}