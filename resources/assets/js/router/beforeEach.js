import store from '../store'

export default async (to, from, next) => {

    if(!store.getters['auth/hasToken' && localStorage != '']){
      await store.dispatch('auth/ActionCheckToken')
    }else{
        next();
    }
}
