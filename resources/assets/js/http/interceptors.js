import store from '../store'

export default req => {
  return ({ status }) => {

    if(status === 401){
        store.dispatch('auth/ActionSignOut')
    }

    if(status === 400){
        store.dispatch('auth/ActionRefresh')
    }


  }

}
