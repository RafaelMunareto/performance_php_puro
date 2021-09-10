import * as types from './mutation-types'

export default {

    [types.SET_ADM] (state, payload) {

        state.adm = payload
    },

    [types.SET_ADM_PAG] (state, payload) {

        state.admPag = payload
    },

    [types.SET_ADM_PAGINATION] (state, payload) {

        state.admPagination = payload
    },

}
