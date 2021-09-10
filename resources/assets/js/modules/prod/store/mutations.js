import * as types from './mutation-types'

export default {

    [types.SET_PROD] (state, payload) {

        state.prod = payload
    },

    [types.SET_PROD2] (state, payload) {

        state.prod2 = payload
    },


    [types.SET_PROD_PAG] (state, payload) {

        state.prodPag = payload
    },

    [types.SET_PROD_PAGINATION] (state, payload) {

        state.prodPagination = payload
    },

}
