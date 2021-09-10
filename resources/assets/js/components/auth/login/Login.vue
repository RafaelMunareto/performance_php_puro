<template>


    <vc-loading style='height:8rem' class='mr-5' v-if='loading'></vc-loading>

    <div class='col-12' v-else>

        <form  method='POST' id='myForm' class='d-flex flex-column justify-content-center align-center animated fadeIn'>
            <vc-mensagem class='col-5' :mensagem_success="mensagem_success" :mensagem_error="mensagem_error"></vc-mensagem>
            <slot></slot>
            <input name='email' class='neomorphic-input margin-05 padding-1 borderRadius-20 validate col-4' placeholder='Email' required id="email" type="email" v-model='form.email'>
            <input name='password' class='neomorphic-input margin-05 padding-1 borderRadius-20 validate col-4' placeholder='Senha' required min="6" type="password" v-model='form.password'>
            <button type='submit' @click="send($event)" class='neomorphic-buttom margin-05 padding-1 borderRadius-20 text-red mt-4 buttonTransform animated-bounce-buttom col-4'><i class="fas fa-lock"></i> ACESSAR </button>
        </form>

    </div>

</template>

<script>

import { mapActions} from 'vuex'
import VcMensagem from '../../shared/Mensagem.vue';
import VcLoading from '../../shared/Loading.vue'

export default {

     components:{
        VcMensagem,
        VcLoading
    },

    data(){
        return {
            mensagem_error:'',
            mensagem_success:'',
            loading:'',
            form:{
                email:'',
                password:'',
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }
    },

    methods:{

       ...mapActions('auth', ['ActionDoLogin']),

        async send(event){
            event.preventDefault()
            try{
                this.loading = true
                await this.ActionDoLogin(this.form)
            }catch(err){
                this.loading = false
                this.mensagem_fail('Verifique seu login e senha!')
            }finally{
                this.loading = false
                if(!this.mensagem_error){
                    this.mensagem_ok('Logando o sistema ...')
                }
            }
            setTimeout(function () {$( "#myForm" ).submit()}.bind(this), 10)
        },

        mensagem_fail(mensagem){
            this.mensagem_error = mensagem
        },

        mensagem_ok(mensagem){
            this.mensagem_success = mensagem
        },
    }
}
</script>

<style lang='"scss" scoped>

@mixin flex-center ($columns:false){
    display:flex;
    align-items:center;
    justify-content: center

    @if $columns{
        flex-direction:column
    }
}

</style>>
