import { categorias_url } from './common'
import { get, post } from './requests'

async function agregar(data) {
    const url = `${categorias_url}/agregar`

    const response = await post(url, data)
    return response.json()
}

async function modificar(data) {
    const url = `${categorias_url}/modificar`

    const response = await fetch(url, data)
    return response.json()
}

async function cargarTodos() {
    const url = `${categorias_url}/list`

    const response = await get(url)
    return response.json()
}

async function eliminar(data) {
    const url = `${categorias_url}/eliminar`

    const response = await post(url, data)
    return response
}

async function cargar(data) {
    const url = `${categorias_url}/mostrar`

    const response = await get(url, data)
    return response.json()
}

export { agregar, modificar, cargar, eliminar, cargarTodos }