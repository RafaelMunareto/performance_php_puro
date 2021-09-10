import * as types from './mutation-types'

export default {

    [types.SET_FUNC] (state, payload) {

        state.func = payload
    },

    [types.SET_FUNC_PAG] (state, payload) {

        state.funcPag = payload
    },

    [types.SET_FUNC_PAGINATION] (state, payload) {

        state.funcPagination = payload
    },

}
