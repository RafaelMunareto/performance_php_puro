<template>


</template>

<script>

import { mapActions, mapState} from 'vuex'

export default {

    props:['check'],

    computed:{
        ...mapState('auth', ['token'])
    },

    methods:{
        ...mapActions('auth', ['ActionSignOut']),
        async sair() {await this.ActionSignOut()}
    },

    mounted(){
        if(this.token && !this.check){
            this.sair()
        }
    }


}

</script>

