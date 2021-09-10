
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
                    <a href='#' @click="sort($event, 'cod_item')" class='neomorphic-table-thead col-1 justify-content-center'><div><span>COD ITEM</span></div>
                    <a href='#' @click="sort($event, 'nome_item')" class='neomorphic-table-thead col-4'><div ><span>NOME ITEM</span></div></a>
                    <a href='#' @click="sort($event, 'categoria')" class='neomorphic-table-thead col-2'><div><span>CATEGORIA</span></div></a>
                    <a href='#' @click="sort($event, 'obj')" class='neomorphic-table-thead col-1'><div><span>META</span></div></a>
                    <a href='#' @click="sort($event, 'peso')" class='neomorphic-table-thead col-1'><div class='d-flex justify-content-center'><span>PESO</span></div></a>
                    <a class='neomorphic-table-thead col-1'><div class='d-flex justify-content-center'><span>EXCLUIR</span></div></a>
                </div>
                <div v-for="u of orderBy(buscaFiltro, sortProperty, sortDirection)" :key="u.id"  class='row'>
                    <div class='neomorphic-table col-1 justify-content-center'><span >{{ u.cod_item }}</span></div>
                    <div class='neomorphic-table col-4'><span >{{ u.nome_item }}</span></div>
                    <div class='neomorphic-table col-2'><span >{{ u.categoria }}</span></div>
                    <div class='neomorphic-table col-1'><span >{{ u.obj  | number('0,0', { thousandsSeparator: '.' })}}</span></div>
                    <div class='neomorphic-table col-1 justify-content-center'><span >{{ u.peso }}</span></div>
                    <div class='neomorphic-table col-1 justify-content-center'>
                        <vc-button
                            icone='fas fa-trash text-red'
                            mensagem='Confirma a exclusão do item?'
                            :item="u.nome_item"
                            :id='u.id'
                            @ativado="remove(u)"
                            :confirmacao='true'
                            estilo='excluir'>
                        </vc-button>
                    </div>
                </div>
            </div>

            <vc-pagination v-show="visivel" :source='this.admPagination' @navigate="navigate"></vc-pagination>

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

    props: {

        cod_func:{
            type:String,
            required:true
        }
    },

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
                return this.adm.filter(adm => exp.test([adm.cod_item,adm.nome_item,adm.categoria,adm.obj,adm.peso ]));
            } else {
                this.visivel = true
                return this.admPag;
            }
        },

        ...mapState('adm', ['adm', 'admPag', 'admPagination']),

    },

    methods:{

        ...mapActions('adm', ['ActionAdm', 'ActionAdmPag', 'ActionAdmDelete']),

        navigate (page){
            this.page = page
            this.atualizaBasePag(this.cod_func, this.date, this.paginate, this.page)
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
               this.ActionAdmDelete(u.id)
            }catch (err){
                  console.log('Não foi possível deletar')
            }finally{
                this.atualizaBasePag(this.cod_func,this.date,this.paginate, this.page)
                this.atualizaBase(this.cod_func, this.date)
                this.mensagem_ok(`Item ${u.nome_item} excluído com sucesso!`)
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

       async atualizaBase(id,date){
            try{
                await this.ActionAdm({id, date})
            }catch (err){
                  console.log('Não foi possível carregar a página')
            }finally{
                this.loading = false
            }
        },

        atualizaBasePag(id,date,paginate,page){
            this.ActionAdmPag({id,date,paginate,page})
        },

        getData(){

            this.atualizaBase(this.cod_func, this.date)
            this.atualizaBasePag(this.cod_func,this.date,this.paginate,this.page)
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

