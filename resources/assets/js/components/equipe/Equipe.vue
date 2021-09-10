
<template>

    <div>

        <vc-loading v-if='loading'></vc-loading>

        <div v-else>

            <div class='d-flex space-between'>
                <vc-busca class='col-4' v-on:input.native="filtro = $event.target.value" ></vc-busca>
                <vc-mensagem  class='col-7 ml-3' :mensagem_success="mensagem_success" :mensagem_error="mensagem_error"></vc-mensagem>
            </div>

            <div class='ml-1'>
                <div class='row'>
                    <a href='#' @click="sort($event, 'cod_func')" class='neomorphic-table-thead col-2 d-flex justify-content-center'><div><span>COD FUNC</span></div>
                    <a href='#' @click="sort($event, 'nome')" class='neomorphic-table-thead col-5'><div ><span>NOME ITEM</span></div></a>
                    <a class='neomorphic-table-thead col-1'><div class='d-flex justify-content-center'><span>VINCULA</span></div></a>
                    <a class='neomorphic-table-thead col-1'><div class='d-flex justify-content-center'><span>EDITAR</span></div></a>
                    <a class='neomorphic-table-thead col-1'><div class='d-flex justify-content-center'><span>EXCLUIR</span></div></a>
                </div>
                <div v-for="u of orderBy(buscaFiltro, sortProperty, sortDirection)" :key="u.id"  class='row'>
                    <div class='neomorphic-table col-2 justify-content-center'><span >{{ u.cod_func }}</span></div>
                    <div class='neomorphic-table col-5'><span >{{ u.nome }}</span></div>
                    <div class='neomorphic-table col-1  d-flex justify-content-center'><a :href="`/vinculacao/${u.cod_func}`"><i class="fas fa-user-plus fa-1x text-orange size125"></i></a></div>
                    <div class='neomorphic-table col-1  d-flex justify-content-center'><a :href="`/equipe/editar/${u.id}`"><i class="fas fa-eraser fa-1x text-green size125"></i></a></div>
                    <div class='neomorphic-table col-1  d-flex justify-content-center'>
                        <vc-button
                                icone='fas fa-trash text-red fa-1x'
                                mensagem='Confirma a exclusão do funcionário'
                                :item="u.nome"
                                :id='u.id'
                                @ativado="remove(u)"
                                :confirmacao='true'
                                estilo='excluir'>
                        </vc-button>
                    </div>
                </div>
            </div>

            <vc-pagination v-show="visivel" :source='this.funcPagination' @navigate="navigate"></vc-pagination>

        </div>
    </div>

</template>

<script>

import Vue2Filters from 'vue2-filters'
import VcPagination from '../shared/Pagination.vue'
import VcButton from '../shared/Button.vue'
import VcBusca from '../shared/Busca.vue'
import VcMensagem from '../shared/Mensagem.vue';
import VcLoading from '../shared/Loading.vue'


import { mapState, mapActions, mapGetters } from 'vuex'


export default {

    mixins: [Vue2Filters.mixin],

    components:{
        VcPagination,
        VcButton,
        VcBusca,
        VcMensagem,
        VcLoading
    },


    data() {
        return{
            sortProperty: 'nome',
            sortDirection: 1,
            filtro:'',
            visivel:true,
            mensagem_success:'',
            mensagem_error:'',
            date:0,
            paginate:7,
            loading: true,
            page:1
        }
    },

    computed:{

        buscaFiltro() {

            if (this.filtro) {
                let exp = new RegExp(this.filtro.trim(), 'i');
                this.visivel = false
                return this.func.filter(adm => exp.test([adm.cod_func,adm.nome ]));
            } else {
                this.visivel = true
                return this.funcPag;
            }
        },

        ...mapState('func', ['func', 'funcPag', 'funcPagination']),

    },

    methods:{

        ...mapActions('func', ['ActionFunc', 'ActionFuncPag', 'ActionFuncDelete']),

        navigate (page){
            this.page = page
            this.atualizaBasePag(this.paginate, this.page)
        },

        sort(ev, property){
            ev.preventDefault()
            this.sortProperty = property
            if(this.sortDirection == 1) {
                this.sortDirection = -1
            }else{
                this.sortDirection = 1
            }
        },

        remove(u) {

            try{
               this.ActionFuncDelete(u.id)
            }catch (err){
                  console.log('Não foi possível deletar')
            }finally{
                this.atualizaBasePag(this.paginate, this.page)
                this.atualizaBase()
                this.mensagem_ok(`${u.nome} excluído com sucesso!`)
            }
        },

        mensagem_ok(mensagem){
            this.mensagem_success = mensagem
            setTimeout(function () {this.mensagem_success = ''}.bind(this), 3000)
        },

        mensagem_fail(mensagem){
            this.mensagem_error = mensagem
            setTimeout(function () {this.mensagem_error = ''}.bind(this), 3000)
        },

        async atualizaBasePag(paginate,page){
             try{
                await this.ActionFuncPag({paginate,page})

            }catch (err){
                  console.log('Não foi possível carregar a página')
            }finally{
                this.loading = false
            }

        },

        async atualizaBase(date){
            try{
                await this.ActionFunc({date})
            }catch (err){
                  console.log('Não foi possível carregar a página')
            }finally{
                this.loading = false
            }
        },

        getData(){

            this.atualizaBase()
            this.atualizaBasePag(this.paginate,this.page)
        }
    },

    mounted(){
        this.getData()
    }
}

</script>

<style scoped>

td{
    padding:0;
}

a{
    text-decoration: none;
    color:#0288d1
}

.neomorphic-table{
    box-shadow:  inset 2px 2px 5px #BECBD8, inset -5px -5px 10px #e0eaf5;
    border-radius: 10px;
    margin:0.5rem;
    font-size:80%;
    vertical-align: middle;
    display: flex;
    align-items: center;
}

.neomorphic-table-thead{
    background-color: #e0eaf5;
    box-shadow: 3px 3px 3px #BECBD8, -1px -1px 10px #e0eaf5;
    border-left: 1px solid #F3F9FF;
    border-top: 1px solid #F3F9FF;
    border-radius: 10px;
    margin:0.5rem;
    padding:0.5rem;
    font-size:80%;
    vertical-align: middle;
}


</style>

