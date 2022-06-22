// @Imports 
import { cargarTodos } from './servicios/ventas.operaciones'
import { dt_language_options } from './servicios/constants'

// @Funciones
let table = new DataTable('#datatable', {
    language: dt_language_options,
    paginate: false,
    info: false,
    search: {
        return: true
    },
    ajax: (d, cb) => {
        cargarTodos()
            .then(data => cb(data))
            .catch(error => console.log(error))
    },
    columns: [
        { data: null },
        { data: null },
        { data: 'fecha_ingreso' },
    ],
    columnDefs: [
        {
            targets: 0,
            render: (data, type, row, meta) =>
                `<a href="detalles?id=${data.id}" class="text-decoration-none">${data.id}</a>`
        },
        {
            targets: 1,
            render: (data, type, row, meta) => `$${data.total}`
        }
    ]
})