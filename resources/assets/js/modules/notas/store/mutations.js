import * as types from './mutation-types'

export default {

    [types.SET_NOTAS] (state, payload) {

        state.notas = payload
    },

    [types.SET_NOTAS_PAG] (state, payload) {

        state.notasPag = payload
    },

    [types.SET_NOTAS_PAGINATION] (state, payload) {

        state.notasPagination = payload
    },

}
