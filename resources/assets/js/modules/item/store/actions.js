import services from '../../../http/index'
import * as types from './mutation-types'

export const ActionItens = ({ commit }, payload) => (
    services.item.item(payload).then(res => {
        commit(types.SET_ITENS, res.data)
}))

export const ActionItensDelete = ( context, payload ) => (
    services.item.delete({id: payload})
)


export const ActionItensPag = ({ commit }, payload) => (
    services.item.item(payload).then(res => {
        commit(types.SET_ITENS_PAG, res.data.data)
        commit(types.SET_ITENS_PAGINATION, res.data)
}))
