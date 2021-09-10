import services from '../../../http/index'
import * as types from './mutation-types'

export const ActionAdm = ({ commit }, payload) => (
    services.adm.adm(payload).then(res => {
        commit(types.SET_ADM, res.data)
}))

export const ActionAdmDelete = ( context, payload ) => (
    services.adm.delete({id: payload})
)

export const ActionAdmDeleteData = ( context, payload ) => (
    services.adm.deleteData({excluirData: payload})
)


export const ActionAdmPut = (context,payload) => (
    services.adm.put({id:payload.id},payload)

)

export const ActionAdmSave = ( context, payload ) => (
    services.adm.save(payload)
)

export const ActionAdmPag = ({ commit }, payload) => (
services.adm.adm(payload).then(res => {
    commit(types.SET_ADM_PAG, res.data.data)
    commit(types.SET_ADM_PAGINATION, res.data)
}))
