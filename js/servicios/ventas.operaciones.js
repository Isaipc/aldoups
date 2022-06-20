import { ventas_url as _url } from './common'
import { get, post } from './requests'

async function agregar(data) {
    const url = `${_url}/agregar`

    const response = await post(url, data)
    return response.json()
}

async function cargarTodos() {
    const url = `${_url}/list`

    const response = await get(url)
    return response.json()
}

async function cargar(data) {
    const url = `${_url}/mostrar`

    const response = await get(url, data)
    return response.json()
}

export { agregar, cargar, cargarTodos }