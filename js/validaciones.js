//validacion de ingresion
const estaVacio = (texto) => texto === ''

const esNumeroPositivo = (texto) => /^\d+(\.\d+)?$/.test(texto)

export { estaVacio, esNumeroPositivo }