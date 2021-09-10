export default {
    adm: { method: 'get', url: 'adm{/id}{?date=}{?paginate=}{?page=}{?cod_item=}' },
    delete: { method: 'delete', url: 'adm{/id}{?data=}' },
    deleteData: { method: 'get', url: 'adm{?excluirData=}' },
    save: { method: 'post', url: 'adm' },
    put: { method: 'put', url: 'adm{/id}' },
}
