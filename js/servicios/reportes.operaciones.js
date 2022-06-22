import {reportes_url as _url } from './constants'
import { get } from './requests'

async function cargarTotalProductosVendidos() {
    const url = `${_url}/total-productos-vendidos-list`

    const response = await get(url)
    return response.json()
}

export { cargarTotalProductosVendidos }