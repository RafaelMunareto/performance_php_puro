import services from '../../../http/index'
import * as types from './mutation-types'

export const ActionNotas = ({ commit }, payload) => (
    services.notas.notas(payload).then(res => {
        commit(types.SET_NOTAS, res.data)
}))

export const ActionNotasPut = (context,payload) => (
    services.notas.put({id:payload.id},payload)

)

export const ActionNotasSave = ( context, payload ) => (
    services.notas.save(payload)
)

export const ActionNotasPag = ({ commit }, payload) => (
    services.notas.notas(payload).then(res => {
        commit(types.SET_NOTAS_PAG, res.data.data)
        commit(types.SET_RANNKING_PAGINATION, res.data)
}))
