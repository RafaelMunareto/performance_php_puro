import state from './state'

export default {

    notaFinal: state => {
        return state.ranking2.filter((i) => i.notaFinal)
    },

    dataRanking: state => {
        return state.ranking2.filter((i) => i.data)
    },
}
