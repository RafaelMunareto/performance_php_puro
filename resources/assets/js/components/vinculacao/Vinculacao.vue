
<template>

    <div>

        <vc-loading v-if='loading'></vc-loading>

        <div v-else>

            <div class='d-flex space-between align-center'>
                <vc-busca class='col-4' v-on:input.native="filtro = $event.target.value" ></vc-busca>
                <vc-mensagem  class='col-7 ml-3' :mensagem_success="mensagem_success" :mensagem_error="mensagem_error"></vc-mensagem>
            </div>

            <div class='ml-1'>
                <div class='row'>
                    <a class='neomorphic-table-thead col-1'><div class='d-flex justify-content-center'><span>VINCULA</span></div></a>
                    <a href='#' @click="sort($event, 'cod_item')" class='neomorphic-table-thead col-1 margin-05 padding-05 justify-content-center'><div><span>COD ITEM</span></div>
                    <a href='#' @click="sort($event, 'nome_item')" class='neomorphic-table-thead col-4'><div ><span>NOME ITEM</span></div></a>
                    <a href='#' @click="sort($event, 'categoria')" class='neomorphic-table-thead col-2'><div><span>CATEGORIA</span></div></a>
                    <a href='#' @click="sort($event, 'obj')" class='neomorphic-table-thead col-1'><div><span>META</span></div></a>
                    <a href='#' @click="sort($event, 'peso')" class='neomorphic-table-thead col-1'><div class='d-flex justify-content-center'><span>PESO</span></div></a>
                </div>

                <div class='d-flex align-center ml-3'>
                    <vc-button
                        icone='fas fa-2x fa-plus-circle text-blue neomorphic-card borderRadius-50 animated-bounce-buttom'
                        mensagem='Confirma a inclusão de todos os itens dessa página?'
                        @ativado="saveall()"
                        :confirmacao='true'
                        estilo='adicionar'>
                    </vc-button>
                    <span class='neomorphic-conc padding-05 borderRadius-10 font-weight-40 size70'>SELECIONAR TODOS</span>
                </div>

                <div v-for="u of orderBy(buscaFiltro, sortProperty, sortDirection)" :key="u.id"  class='row'>
                    <div class='col-1 margin-05 d-flex justify-content-center align-center'>
                        <input :checked='check(u)' @click='save(u, $event)' :id='`check${u.cod_item}`' class='checkbox-group__checkbox' type="checkbox">
                    </div>
                    <div class='neomorphic-table col-1 justify-content-center'><span >{{ u.cod_item }}</span></div>
                    <div class='neomorphic-table col-4'><span >{{ u.nome_item }}</span></div>
                    <div class='neomorphic-table col-2'><span >{{ u.categoria }}</span></div>
                    <div class='neomorphic-table col-1'><span >{{ u.obj  | number('0,0', { thousandsSeparator: '.' })}}</span></div>
                    <div class='neomorphic-table col-1 justify-content-center'><span >{{ u.peso }}</span></div>
                </div>
            </div>

            <vc-pagination v-show="visivel" :source='this.itensPagination' @navigate="navigate"></vc-pagination>

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
import Vincula from '../classe/Adm.js'
import { mapState, mapActions, mapGetters } from 'vuex'

export default {

    mixins: [Vue2Filters.mixin],

    props: {

        cod_func:{
            type:String,
            required:true
        },
        nome_func:{
            type:String,
            required:true
        },
         lastdate:{
            type:String,
            required:true
        },
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
            page:1,
            vincula:''
        }
    },

    computed:{

        buscaFiltro() {

            if (this.filtro) {
                let exp = new RegExp(this.filtro.trim(), 'i');
                this.visivel = false
                return this.itens.filter(itens => exp.test([itens.cod_item,itens.nome_item,itens.categoria,itens.obj,itens.peso ]));
            } else {
                this.visivel = true
                return this.itensPag;
            }
        },

        ...mapState('adm', ['adm', 'admPag', 'admPagination']),
        ...mapState('item', ['itens', 'itensPag', 'itensPagination']),
        ...mapState('auth', ['user'])
    },

    methods:{

        ...mapActions('adm', ['ActionAdm', 'ActionAdmPag', 'ActionAdmDelete', 'ActionAdmSave']),
        ...mapActions('item', ['ActionItens', 'ActionItensPag']),

        navigate (page){
            this.page = page
            this.atualizaBasePag(this.date, this.paginate, this.page)
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

        saveall(){

            try{
                this.itensPag.forEach(function(item) {
                    if(!document.getElementById(`check${item.cod_item}`).checked){
                            document.getElementById(`check${item.cod_item}`).click()
                    }
                });
            }catch (err){
                        this.mensagem_fail(`Não foi possível salvar os itens!`)
            }finally{
                this.mensagem_ok(`Itens incluídos com sucesso!`)
            }
        },

        save(u, e){

            this.vincula = new Vincula(this.cod_func,
                                        this.nome_func,
                                        u.cod_item,
                                        u.nome_item,
                                        u.categoria,
                                        u.obj,
                                        0,
                                        u.peso,
                                        0,
                                        0,
                                        this.user.cod_func,
                                        this.lastdate,)



            if (e.target.checked) {
                let busca = this.adm.filter((i) => i.cod_item == u.cod_item)
                if(busca == ''){
                    try{
                        this.ActionAdmSave(this.vincula)
                        this.atualizaBase(this.date)
                    }catch (err){
                        this.mensagem_fail(`Não foi possível salvar o item ${u.nome_item}`)
                    }finally{
                        this.mensagem_ok(`Item ${u.nome_item} salvo com sucesso!`)
                    }
                }
            }else{
                let buscaId = this.adm.filter((i) => i.cod_item == u.cod_item)
                buscaId.forEach(function(item) { buscaId = item.id});
                try{
                    this.ActionAdmDelete(buscaId)
                    this.atualizaBase(this.date)
                }catch (err){
                      console.log('Não foi possível deletar')
                }finally{
                    this.mensagem_ok(`Item ${u.nome_item} excluído com sucesso!`)
                }
            }
        },

        check(u){
            let check = this.adm.filter((i) => i.cod_item == u.cod_item)
            if(check != ''){
               return 'true'
            }
        },

        mensagem_ok(mensagem){
            this.mensagem_success = mensagem
            setTimeout(function () {this.mensagem_success = ''}.bind(this), 1000)
        },

        mensagem_fail(mensagem){
            this.mensagem_error = mensagem
            setTimeout(function () {this.mensagem_error = ''}.bind(this), 1000)
        },

        async atualizaBase(date){
            try{
                await this.ActionItens({date:date})
                await this.ActionAdm({id:this.cod_func, date:date})
             }catch (err){
                  console.log('Não foi possível carregar a página')
            }finally{
                this.loading = false
            }
        },

        async atualizaBasePag(date,paginate,page){
            try{
                await this.ActionItensPag({date:date,paginate:paginate,page:page})
                await this.ActionAdmPag({id:this.cod_func, date:date, paginate:paginate, page:page})
            }catch (err){
                console.log('Não foi possível carregar a página')
            }finally{
                this.loading = false
            }
        },

        async getData(){
            await this.atualizaBase(this.date)
            await this.atualizaBasePag(this.date,this.paginate,this.page)
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
    padding:0.5rem
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

