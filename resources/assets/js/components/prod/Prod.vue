
<template>

    <div class='row margin-1 animated fadeIn'>

        <div class='col-12'>
            <div>
                <div class='d-flex space-between'>
                    <span class='size80 font-weight-bold'>{{ data_atual }}</span>
                    <vc-mensagem  class='col-7 ml-3' :mensagem_success="mensagem_success" :mensagem_error="mensagem_error"></vc-mensagem>
                </div>
                <div class='d-flex neomorphic-card justify-content-center mb-2 padding-05 borderRadius-10'>
                    <select2
                        :options="getSelectFunc"
                        v-on:selected="validateSelectionFunc"
                        data="dataBig2x"
                        :disabled="false"
                        placeholder="Escolha o Funcionário">
                    </select2>
                </div>


                <div class='d-flex justify-content-between'>

                    <div class='d-flex neomorphic-card mb-2 padding-05 borderRadius-10'>
                        <select2
                            :options="getSelectItem"
                            v-on:selected="validateSelectionItem"
                            data="dataBig2x"
                            :disabled="false"
                            placeholder="Escolha o item">
                        </select2>
                    </div>

                    <div class='d-flex neomorphic-card mb-2 padding-05 borderRadius-10'>
                        <select2
                            :options="getSelectProd"
                            v-on:selected="validateSelectionProd"
                            :disabled="false"
                            data='dataBig2x'
                            placeholder="Escolha o bloco de produção">
                        </select2>
                    </div>
                </div>

                <div class='d-flex justify-content-center'>
                    <grafico-radar :nome='nomeGrafico' :data='dataGrafico'></grafico-radar>
                </div>

            </div>
        </div>

    </div>

</template>

<script>

import Vue2Filters from 'vue2-filters'
import VcButton from '../shared/Button.vue'
import VcBusca from '../shared/Busca.vue'
import VcMensagem from '../shared/Mensagem.vue';
import Select2 from '../shared/Select2.vue'
import GraficoRadar from '../shared/GraficoRadar.vue'
import VcPagination from '../shared/Pagination.vue'



import { mapState, mapActions, mapGetters } from 'vuex'


export default {


    mixins: [Vue2Filters.mixin],

    components:{
        VcPagination,
        VcButton,
        VcBusca,
        VcMensagem,
        Select2,
        VcPagination,
        GraficoRadar
    },


    data() {
        return{
            sortProperty: 'perc',
            sortDirection: -1,
            filtro:'',
            visivel:true,
            mensagem_success:'',
            mensagem_error:'',
            date:0,
            data_atual:'',
            paginate:7,
            loading: '',
            cod_func:'',
            page:1,
            cod_prod:'',
            cod_item:'',
            aceitos:'',
            fechados:'',
            abordados:'',
            perc:'',
            nome_graf:''

        }
    },

    computed:{


        getSelectItem(){

            var getSelectCod_item = this.itens.map( select => {
                return{
                    name: select.nome_item,
                    id: select.cod_item
                }
            })

            return getSelectCod_item;
        },

         getSelectProd(){

            var getSelectFuncData = this.nome_prod.map( select => {
                return{
                    name: select.bloco + ' - ' +  select.cod_prod,
                    id: select.cod_prod
                }
            })
            return getSelectFuncData;
        },

        nomeGrafico(){
             if(this.cod_prod){
                return this.nome_graf
             }
        },

        dataGrafico(){

            if(this.cod_prod){
                let perc = ''
                let data = ''
                this.adm.forEach(function(item){
                    perc = (item.perc).toFixed(2)
                });

                this.prod.forEach(function(item){
                    data = item.data
                });

                this.data_atual = data;

                this.perc = perc;

                let abordados = ''
                let aceitos = ''
                let fechados = ''
                let nome_graf = ''

                this.prod.forEach(function(item){
                    nome_graf =  item.nome_prod
                    abordados = (item.abordados*100).toFixed(2)
                    aceitos = (item.aceitos*100).toFixed(2)
                    fechados = (item.fechados*100).toFixed(2)
                });

                this.abordados = abordados
                this.aceitos = aceitos
                this.fechados = fechados
                this.nome_graf = nome_graf

                return [this.perc, this.abordados, this.fechados, this.aceitos]

            }else{
                return [0,0,0,0]
            }

        },

        getSelectFunc(){

            var getSelectFuncData = this.func.map( select => {
                return{
                    name: select.nome,
                    id: select.cod_func
                }
            })
            return getSelectFuncData;
        },

        ...mapState('prod', ['prod', 'prod2']),
        ...mapState('adm', ['adm']),
        ...mapState('func', ['func']),
        ...mapState('item', ['itens', 'itensPag', 'itensPagination']),
        ...mapGetters('prod', ['nome_prod']),

    },

    methods:{

        ...mapActions('prod', ['ActionProd', 'ActionProd2']),
        ...mapActions('func', ['ActionFunc', 'ActionFuncPag']),
        ...mapActions('item', ['ActionItens']),
        ...mapActions('adm', ['ActionAdm', 'ActionAdmPag']),

        validateSelectionItem(selection) {
            this.selected = selection;
            this.cod_item = selection.id
            if(this.cod_item){
                try{
                    this.ActionProd2({id:this.cod_func})
                    this.ActionAdm({id:this.cod_func,date:this.date, cod_item:this.cod_item})
                }catch (err){
                    console.log('Não foi possível carregar a página')
                }finally{

                }
            }
        },

        validateSelectionProd(selection) {
            this.selected = selection;
            this.cod_prod = selection.id

                try{
                    this.ActionProd({id:this.cod_func,cod_item:this.cod_prod})

                }catch (err){
                    console.log('Não foi possível carregar a página')
                }finally{

                }

        },

         validateSelectionFunc(selection) {
            this.selected = selection;
            this.cod_func = selection.id

            if(this.cod_func){
                try{
                    this.ActionItens()
                }catch (err){
                    console.log('Não foi possível carregar a página')
                }finally{

                }

            }
        },

        percColor(u){

            if(u.perc >= 100){
                return `text-blue`
            }else if(u.perc >= 90 && u.perc < 100 ){
                return `text-green`
            }else if (u.perc >=80 && u.perc < 90){
                return `text-orange`
            }else{
                return `text-red`
            }
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

    },

    mounted(){
        this.ActionFunc()
    }
}

</script>

<style scoped>


</style>

