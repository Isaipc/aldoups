// @Imports 
import { cargar, cargarTodos } from "./servicios/productos.operaciones";
import { estaVacio } from './validaciones'

// Variables
let productos = []

// Elementos de la pagina
const _carrito = document.getElementById('carrito')
const _form = document.getElementById('form')
const _errores = document.getElementById('errores')
const _producto = document.getElementById('producto')
const _precio = document.getElementById('precio')
const _cantidad = document.getElementById('cantidad')
const _total = document.getElementById('total')


// Ejecutar funciones al cargar la pagina:
cargarProductosOptions()

// @Funciones
function cargarProductosOptions() {
    cargarTodos()
        .then(data => renderProductosOptions(data))
        .catch(error => console.log(error))
}
function calcularTotal() {
    return productos.reduce((total, d) => parseFloat(d.precio) + parseFloat(total), 0);
}

function agregarProducto(data) {
    productos.push(data)

    _carrito.innerHTML +=
        `<tr>
            <td>${data.nombre}</td>
            <td>${data.precio}</td>
            <td>${data.cantidad}</td>
            <td class="text-end">${data.cantidad * data.precio}</td>
        </tr>`
}

function getProducto() {
    return {
        id: _producto.options[_producto.selectedIndex].value,
        nombre: _producto.options[_producto.selectedIndex].text,
        precio: _precio.value,
        cantidad: _cantidad.value,
    }
}

function validaciones() {

    let valid = true
    let errores = []

    if (estaVacio(_producto.value)) {
        errores.push(`Debe llenar el campo 'producto'`)
        _producto.classList.add('is-invalid')
        valid = false
    }

    if (estaVacio(_cantidad.value)) {
        errores.push(`Debe llenar el campo 'cantidad'`)
        _cantidad.classList.add('is-invalid')
        valid = false
    }

    _errores.innerHTML = errores.map(e => `<li>${e}</li>`).join('')
    document.body.querySelector('.error').classList.remove('d-none')

    return valid
}

function renderProductosOptions(data) {

    const options = data.map((d, index) => {
        return `<option value="${d.id}">${d.nombre}</option>`
    })

    document.getElementById('producto').innerHTML += options.join('')
}


// @Eventos
_form.addEventListener('submit', (event) => {
    event.preventDefault()

    if (!validaciones())
        return false

    const data = getProducto()
    agregarProducto(data)
    _total.innerHTML = calcularTotal()
    document.body.querySelector('.error').classList.add('d-none')
})

_producto.addEventListener('change', () => {

    _producto.classList.remove('is-invalid')
    const data = { id: _producto.value }

    cargar(data)
        .then(data => { _precio.value = data.precio })
        .catch(error => console.log(error))

})

_cantidad.addEventListener('keydown', () => _cantidad.classList.remove('is-invalid'))