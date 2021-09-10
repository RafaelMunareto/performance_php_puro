
<template>

    <div class='d-flex flex-column'>

        <div>
            <div>

                <div class='d-flex justify-content-center'>
                    <div class='d-flex neomorphic-card mb-2 padding-05 borderRadius-10'>
                        <select2
                            @ativado='loadingAction()'
                            :options="getDataSelect"
                            v-on:selected="validateSelection"
                            data="dataBig2x"
                            :disabled="false"
                            placeholder="Escolha o item">
                        </select2>

                        <select2
                            @ativado='loadingAction()'
                            :options="getDataSelectData"
                            v-on:selected="validateSelectionData"
                            :disabled="false"
                            data='data'
                            placeholder="Escolha a data">
                        </select2>
                    </div>
                    <div class='d-flex justify-content-center align-center'>
                        <button
                            class='neomorphic-buttom borderRadius-10 padding-05 ml-2 mb-1 neomorphic-text-gray size90 animated-bounce-buttom'>
                            <i class="fa fa-medal text-orange"></i>
                            NOTA FINAL
                        </button>
                    </div>
                    <span v-if='loading2' class='d-flex align-center text-blue ml-2'>
                        <b-spinner class="align-middle "></b-spinner>
                    <span>
                </div>
            </div>


        </div>

            <grafico-mosaico ></grafico-mosaico>

    </div>


</template>

<script>

import Vue2Filters from 'vue2-filters'
import VcPagination from '../shared/Pagination.vue'
import VcButton from '../shared/Button.vue'
import VcBusca from '../shared/Busca.vue'
import VcMensagem from '../shared/Mensagem.vue';
import VcLoading from '../shared/Loading.vue'
import Select2 from '../shared/Select2.vue'
import GraficoMosaico from '../shared/GraficoMosaico.vue'


import { mapState, mapActions, mapGetters } from 'vuex'


export default {

    props:['datas'],

    mixins: [Vue2Filters.mixin],

    components:{
        VcPagination,
        VcButton,
        VcBusca,
        VcMensagem,
        VcLoading,
        Select2,
        GraficoMosaico,
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
            paginate:10,
            loading: '',
            page:1,
            cod_item:'',
            selectDate:'',
            loading2:false,
            rank:[]
        }
    },

    computed:{


        notasGrafico(){

            let cem = this.adm.filter((i) => i.perc >= 100)
            let noventa = this.adm.filter((i) => i.perc >= 90 && i.perc < 100)
            let oitenta = this.adm.filter((i) => i.perc >= 80 && i.perc < 90)
            let setenta = this.adm.filter((i) => i.perc < 80)
            let total = this.adm.filter((i) => i.perc >=0 )
            let cemCalc = ((cem.length/total.length)*100).toFixed(2)
            let noventaCalc = ((noventa.length/total.length)*100).toFixed(2)
            let oitentaCalc = ((oitenta.length/total.length)*100).toFixed(2)
            let setentaCalc = ((setenta.length/total.length)*100).toFixed(2)

             return [cemCalc, noventaCalc, oitentaCalc, setentaCalc]
        },

        getDataSelect(){

            var getSelectCod_item = this.itens.map( select => {
                return{
                    name: select.nome_item,
                    id: select.cod_item
                }
            })
            return getSelectCod_item;
        },

         getDataSelectData(){

            var getSelectFuncData = this.datas.map( select => {
                return{
                    name: select.data,
                    id: select.data
                }
            })
            return getSelectFuncData;
        },

        ...mapState('adm', ['adm', 'admPag', 'admPagination']),
        ...mapState('item', ['itens', 'itensPag', 'itensPagination']),

    },

    methods:{

        ...mapActions('adm', ['ActionAdm', 'ActionAdmPag', 'ActionAdmDelete']),
        ...mapActions('item', ['ActionItens']),

        validateSelection(selection) {
            this.selected = selection;
            this.cod_item = selection.id
            if(this.cod_item && this.selectDate){

                try{
                    this.getData(this.cod_func, this.selectDate, this.paginate,this.page, this.cod_item)
                }catch (err){
                    console.log('Não foi possível carregar a página')
                }finally{
                    this.loading2 == false
                }
            }
        },

        loadingAction(){

            if(this.cod_item && this.selectDate){
                this.loading2 = true
            }
        },

        validateSelectionData(selection) {
            this.ActionItens()
            this.selected = selection;
            this.selectDate = selection.id
            if(this.cod_item && this.selectDate){

                try{
                    this.getData(this.cod_func, this.selectDate, this.paginate,this.page, this.cod_item)
                }catch (err){
                    console.log('Não foi possível carregar a página')
                }finally{
                    this.loading2 = false
                }

            }
        },

       async atualizaBase(date, cod_item){

            try{
                await this.ActionAdm({date,cod_item})
            }catch (err){
                console.log('Não foi possível carregar a página')
            }finally{
                this.loading = false
                this.loading2 = false
            }
        },

        async atualizaBasePag(date,paginate,page,cod_item){

            try{
                await this.ActionAdmPag({date,paginate,page,cod_item})
            }catch (err){
                console.log('Não foi possível carregar a página')
            }finally{
                this.loading = false
                this.loading2 = false
            }
        },

        getData(){
            this.atualizaBase(this.selectDate, this.cod_item)
            this.atualizaBasePag(this.selectDate,this.paginate,this.page, this.cod_item)
        }
    },

    mounted(){
        this.ActionItens()
    }
}

</script>

<style scoped>


</style>

