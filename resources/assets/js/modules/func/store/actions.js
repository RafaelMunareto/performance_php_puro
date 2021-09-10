import services from '../../../http/index'
import * as types from './mutation-types'

export const ActionFunc = ({ commit }, payload) => (
    services.func.func(payload).then(res => {
        commit(types.SET_FUNC, res.data)
}))

export const ActionFuncDelete = ( context, payload ) => (
    services.func.delete({id: payload})
)

export const ActionFuncPag = ({ commit }, payload) => (
services.func.func(payload).then(res => {
    commit(types.SET_FUNC_PAG, res.data.data)
    commit(types.SET_FUNC_PAGINATION, res.data)
}))
