import services from '../../../http/index'
import * as types from './mutation-types'

export const ActionRanking = ({ commit }, payload) => (
    services.ranking.ranking(payload).then(res => {
        commit(types.SET_RANKING, res.data)
}))

export const ActionRanking2 = ({ commit }, payload) => (
    services.ranking.ranking(payload).then(res => {
        commit(types.SET_RANKING2, res.data)
}))

export const ActionRankingPut = (context,payload) => (
    services.ranking.put({id:payload.id},payload)

)

export const ActionRankingSave = ( context, payload ) => (
    services.ranking.save(payload)
)


export const ActionRankingPag = ({ commit }, payload) => (
    services.ranking.ranking(payload).then(res => {
        commit(types.SET_RANKING_PAG, res.data.data)
        commit(types.SET_RANKING_PAGINATION, res.data)
}))
