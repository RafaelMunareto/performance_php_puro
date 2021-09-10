import services from '../../../http/index'
import * as types from './mutation-types'

export const ActionProd = ({ commit }, payload) => (
    services.prod.prod(payload).then(res => {
        commit(types.SET_PROD, res.data)
}))

export const ActionProd2 = ({ commit }, payload) => (
    services.prod.prod2(payload).then(res => {
        commit(types.SET_PROD2, res.data)
}))

export const ActionProdDelete = ( context, payload ) => (
    services.prod.delete({id: payload})
)

export const ActionProdDeleteData = ( context, payload ) => (
    services.prod.deleteData({excluirData: payload})
)


export const ActionProdPut = (context,payload) => (
    services.prod.put({id:payload.id},payload)

)

export const ActionAdmSave = ( context, payload ) => (
    services.prod.save(payload)
)

export const ActionAdmPag = ({ commit }, payload) => (
services.prod.prod(payload).then(res => {
    commit(types.SET_PROD_PAG, res.data.data)
    commit(types.SET_PROD_PAGINATION, res.data)
}))
