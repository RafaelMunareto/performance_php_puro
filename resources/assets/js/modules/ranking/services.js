export default {
    ranking: { method: 'get', url: 'ranking{/id}{?date=}{?paginate=}{?page=}{?orderby=}'},
    save: { method: 'post', url: 'ranking' },
    put: { method: 'put', url: 'ranking{/id}' },
}
