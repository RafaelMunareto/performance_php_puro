import state from './state'

export default {

    nome_prod: state => {
        return state.prod2.filter((i) => i.nome_prod)
    },
    adimp: state => {
        return state.prod.filter((i) => i.bloco == "ADIMPLENCIA")
    },

    cartao: state => {
        return state.prod.filter((i) => i.bloco == "CARTAO DE CRÉDITO PF")
    },

    cdc: state => {
        return state.prod.filter((i) => i.categoria == "CDC")
    },

    consig: state => {
        return state.prod.filter((i) => i.categoria == "CONSIGNADO")
    },

    hab: state => {
        return state.prod.filter((i) => i.categoria == "HABITAÇÃO PF")
    },

    penhor: state => {
        return state.prod.filter((i) => i.categoria == "PENHOR")
    },

    varejo: state => {
        return state.prod.filter((i) => i.categoria == "VAREJO PJ")
    },

}
