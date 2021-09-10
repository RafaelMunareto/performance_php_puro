import store from '../store/index'

export default async (to, from, next) => {
      await store.dispatch('auth/ActionCheckToken')
      next()

}
