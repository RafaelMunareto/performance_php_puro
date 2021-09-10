import * as types from './mutation-types'

export default {

    [types.SET_RANKING] (state, payload) {

        state.ranking = payload
    },

    [types.SET_RANKING2] (state, payload) {

        state.ranking2 = payload
    },


    [types.SET_RANKING_PAG] (state, payload) {

        state.rankingPag = payload
    },

    [types.SET_RANKING_PAGINATION] (state, payload) {

        state.rankingPagination = payload
    },

}
