import * as types from './mutation-types'

export default {

    [types.SET_ITENS] (state, payload) {

        state.itens = payload
    },

    [types.SET_ITENS_PAG] (state, payload) {

        state.itensPag = payload
    },

    [types.SET_ITENS_PAGINATION] (state, payload) {

        state.itensPagination = payload
    },

}
