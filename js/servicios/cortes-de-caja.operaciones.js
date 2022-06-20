import { cortes_de_caja_url as _url} from './constants'
import { get, post } from './requests'

async function agregar(data) {
    const url = `${_url}/agregar`

    const response = await post(url, data)
    return response.json()
}

async function editar(data) {
    const url = `${_url}/editar`

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

export { agregar, editar, cargar, cargarTodos }