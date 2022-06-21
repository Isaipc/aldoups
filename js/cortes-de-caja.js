// @Imports 
import { cargar, cargarTodos } from './servicios/cortes-de-caja.operaciones'

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
            `<td> <a href="detalles/?id=${d.id}" class="text-decoration-none">${d.id}</a></td>` +
            `<td> $${d.efectivo_esperado}</td>` +
            `<td> $${d.efectivo_contado}</td>` +
            `<td> ${d.fecha_ingreso} </td>` +
            `<td> </td>` +
            `</tr>`

        ventas.insertAdjacentHTML('beforeend', fila)
    })
}