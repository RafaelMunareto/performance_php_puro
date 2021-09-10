export default {
    notas: { method: 'get', url: 'nota{/id}{?date=}{?paginate=}{?page=}'},
    put: { method: 'put', url: 'nota{/id}' },
    save: { method: 'post', url: 'nota' },
}
