export default {
    prod: { method: 'get', url: 'prod{/id}{?date=}{?paginate=}{?page=}{?cod_item=}' },
    prod2: { method: 'get', url: 'prod{/id}{?date=}{?paginate=}{?page=}{?cod_item=}' },
    delete: { method: 'delete', url: 'prod{/id}{?data=}' },
    deleteData: { method: 'get', url: 'prod{?excluirData=}' },
    save: { method: 'post', url: 'prod' },
    put: { method: 'put', url: 'prod{/id}' },
}
