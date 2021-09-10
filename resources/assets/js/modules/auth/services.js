export default {
    login: { method: 'post', url: 'auth/login' },
    loadSession: { method: 'get', url: 'auth/load-session' },
    refresh: { method: 'post', url: 'auth/refresh{?token=}' },
}
