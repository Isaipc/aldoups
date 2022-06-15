//validacion de ingresion
const estaVacio = (texto) => texto === ''

const esNumeroPositivo = (texto) => /^\d+$/.test(texto)

export { estaVacio, esNumeroPositivo }