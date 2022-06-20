// @Imports 
import { cargar, cargarTodos } from "./servicios/productos.operaciones";
import { agregar } from "./servicios/ventas.operaciones"
import { estaVacio } from './validaciones'

// Variables
let productos = []
let currentProducto = {}

// Elementos de la pagina
const _guardarBtn = document.getElementById('guardarVenta')
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
    return productos.reduce((total, d) => d.monto + total, 0);
}

function agregarProducto() {

    let data = currentProducto
    data.monto = data.precio * data.cantidad

    const index = productos.findIndex(p => p.id == data.id)

    if (index != -1) {

        productos[index].cantidad += data.cantidad
        productos[index].monto += data.cantidad * data.precio
        data = productos[index]

        const item = document.getElementById(`producto-${data.id}`)
        item.querySelector('.cantidad').textContent = data.cantidad
        item.querySelector('.monto').textContent = data.monto
    }
    else {
        productos.push(data)

        _carrito.innerHTML +=
            `<tr id="producto-${data.id}">
            <td class="nombre">${data.nombre}</td>
            <td class="precio">${data.precio}</td>
            <td class="cantidad">${data.cantidad}</td>
            <td class="monto text-end">${data.monto}</td>
        </tr>`
    }
}

function setCurrentProducto(data) {
    _precio.value = data.precio

    currentProducto = {
        id: data.id,
        nombre: data.nombre,
        precio: parseFloat(data.precio),
        stock: parseInt(data.stock),
        cantidad: parseInt(_cantidad.value),
        monto: 0
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

    if (currentProducto.cantidad > currentProducto.stock) {
        errores.push(`No hay suficiente stock`)
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

    _producto.innerHTML += options.join('')
}

// @Eventos
_form.addEventListener('submit', (event) => {
    event.preventDefault()

    if (!validaciones())
        return false

    document.body.querySelector('.error').classList.add('d-none')

    agregarProducto()
    _total.textContent = calcularTotal()
    _form.reset()
})

_producto.addEventListener('change', () => {

    _producto.classList.remove('is-invalid')

    const data = { id: _producto.value }

    cargar(data)
        .then(data => setCurrentProducto(data))
        .catch(error => console.log(error))
})

_cantidad.addEventListener('change', () => {

    _cantidad.classList.remove('is-invalid')
    currentProducto.cantidad = parseInt(_cantidad.value)
})

_guardarBtn.addEventListener('click', event => {

    if (!confirm('¿Desea registrar la venta?'))
        return false;

    agregar(productos)
        .then(data => {
            console.log(data)
            _carrito.innerHTML = ''
            _total.textContent = 0
            alert('Venta realizada con exito ;)')
        })
        .catch((error) => console.log(error))
})