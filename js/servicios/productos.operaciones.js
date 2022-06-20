import { productos_url } from './constants'
import { get, post } from './requests'

async function agregar(data) {
    const url = `${productos_url}/agregar`

    const response = await post(url, data)
    return response.json()
}

async function editar(data) {
    const url = `${productos_url}/editar`

    const response = await post(url, data)
    return response.json()
}

async function cargarTodos() {
    const url = `${productos_url}/list`

    const response = await get(url)
    return response.json()
}

async function eliminar(data) {
    const url = `${productos_url}/eliminar`

    const response = await post(url, data)
    return response
}

async function cargar(data) {
    const url = `${productos_url}/mostrar`

    const response = await get(url, data)
    return response.json()
}

export { agregar, editar, cargar, eliminar, cargarTodos }