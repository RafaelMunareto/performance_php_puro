import state from './state'

export default {

    sprint: state => {
        return state.adm.filter((i) => i.categoria == "SPRINT")
    },

    prioritario: state => {
        return state.adm.filter((i) => i.categoria == "PRIORITÁRIO")
    },

    direcionador: state => {
        return state.adm.filter((i) => i.categoria == "DIRECIONADOR")
    },

}
