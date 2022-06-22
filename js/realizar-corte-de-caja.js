// @Imports 
import { agregar } from './servicios/cortes-de-caja.operaciones'
import { estaVacio, esNumeroPositivo } from './validaciones'

// Elementos de la pagina
const _errores = document.getElementById('errores')
const _efectivo_contado = document.getElementById('efectivo_contado')

// @Funciones
function validaciones() {

    let valid = true
    let errores = []

    if (estaVacio(_efectivo_contado.value)) {
        errores.push(`Debe llenar el campo 'efectivo contado'`)
        _efectivo_contado.classList.add('is-invalid')
        valid = false
    }

    if (!esNumeroPositivo(_efectivo_contado.value)) {
        errores.push(`El campo 'efectivo contado' solo puede tener valor numerico positivo`)
        _efectivo_contado.classList.add('is-invalid')
        valid = false
    }

    _errores.innerHTML = errores.map(e => `<li>${e}</li>`).join('')

    if (!valid)
        document.body.querySelector('.error').classList.remove('d-none')

    return valid
}

function guardar(data) {

    agregar(data)
        .then(data => {
            alert('holi :)')
            console.log(data)
        })
        .catch((error) => console.log(error))
}

// @Eventos
form.addEventListener('submit', event => {
    event.preventDefault()

    if (!validaciones())
        return false

    document.body.querySelector('.error').classList.add('d-none')

    if (!confirm('¿Esta seguro(a) que desea guardar los cambios?'))
        return false

    const data = { efectivo_contado: _efectivo_contado.value }
    guardar(data)
})

_efectivo_contado.addEventListener('keydown', () => {
    _efectivo_contado.classList.remove('is-invalid')
})
