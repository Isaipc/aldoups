import { reportes_url } from "./servicios/constants";
import { cargarTotalProductosVendidos } from "./servicios/reportes.operaciones";
import { cargar as cargarProducto } from "./servicios/productos.operaciones";

//Elementos necesarios
const _items = document.getElementById('items')
const modalDetalleEl = document.getElementById('modalDetalle')
const modalDetalle = new bootstrap.Modal(modalDetalleEl)

mostrarTodos()

// @Funciones
function mostrarTodos() {
    cargarTotalProductosVendidos()
        .then(data => renderFilas(data))
        .catch(error => console.log(error))
}

function mostrarElemento(id) {

    const data = { id: id }

    cargarProducto(data)
        .then(data => showModalDetalles(data))
        .catch(error => console.log(error))
}

function renderFilas(data) {

    _items.innerHTML = ''

    data.forEach((d, index) => {
        const fila =
            `<tr>` +
            `<td> ${d.id}</td>` +
            `<td>
                <a href="#" class="text-decoration-none btn-show" data-id="${d.id}">${d.nombre}</a>
             </td>` +
            `<td> ${d.total_vendidos} </td>` +
            `<td> ${d.categoria} </td>` +
            `<td> </td>` +
            `</tr>`

        _items.insertAdjacentHTML('beforeend', fila)
    })

    document.querySelectorAll('.btn-show').forEach((btn) => {
        btn.addEventListener('click', event => mostrarElemento(btn.dataset.id))
    })
}


function showModalDetalles(data) {
    modalDetalle.show()
    modalDetalleEl.querySelector('.id').textContent = data.id
    modalDetalleEl.querySelector('.nombre').textContent = data.nombre
    modalDetalleEl.querySelector('.stock').textContent = data.stock
    modalDetalleEl.querySelector('.precio').textContent = data.precio
    modalDetalleEl.querySelector('.categoria').textContent = data.categoria
    modalDetalleEl.querySelector('.descripcion').textContent = data.descripcion
    modalDetalleEl.querySelector('.fecha_ingreso').textContent = data.fecha_ingreso
    modalDetalleEl.querySelector('.fecha_modificacion').textContent = data.fecha_modificacion
}
