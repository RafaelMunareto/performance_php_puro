
<template>

    <div class='row ml-4'>

        <div class='col-7'>
            <div>
                <div class='d-flex space-between'>
                    <div class='d-flex justify-content-start col-10 padding-0 align-center'>
                        <vc-busca class='col-10' v-on:input.native="filtro = $event.target.value" ></vc-busca>
                        <div class='neomorphic-card ml-2 padding-05 mb-1 borderRadius-10'>
                            <select2
                                @ativado='loadingAction()'
                                :options="getDataSelectData"
                                v-on:selected="validateSelectionData"
                                :disabled="false"
                                data='data'
                                placeholder="Escolha a data">
                            </select2>
                        </div>
                        <span v-if='loading2' class='d-flex align-center text-blue ml-2'>
                            <b-spinner class="align-middle "></b-spinner>
                        <span>
                    </div>
                    <vc-mensagem  class='col-7 ml-3' :mensagem_success="mensagem_success" :mensagem_error="mensagem_error"></vc-mensagem>
                </div>
            </div>

            <div class='ml-1'>
                <div class='row'>
                    <a href='#' class='d-flex neomorphic-table-thead col-1 justify-content-center'><div><span>COL</span></div>
                     <a href='#' @click="sort($event, 'cod_func')" class='neomorphic-table-thead col-1 justify-content-center'><div ><span>SUP</span></div></a>
                    <a href='#' @click="sort($event, 'cod_func')" class='neomorphic-table-thead col-1 justify-content-center'><div ><span>COD</span></div></a>
                    <a href='#' @click="sort($event, 'nome_func')" class='neomorphic-table-thead col-5'><div><span>NOME FUNC</span></div></a>
                    <a href='#' @click="sort($event, 'notaFinal')" class='neomorphic-table-thead col-2 justify-content-center'><div><span>NOTA FINAL</span></div></a>
                </div>
                <div v-for="u of orderBy(buscaFiltro, sortProperty, sortDirection)" :key="u.id"  class='row'>
                    <div class='neomorphic-table col-1 justify-content-center'><span>{{ranking.findIndex(x => x.notaFinal === u.notaFinal) + 1}}º</span></div>
                    <div class='neomorphic-table col-1 justify-content-center'><span>{{ u.cod_sup }}</span></div>
                    <div class='neomorphic-table col-1 justify-content-center'><span>{{ u.cod_func }}</span></div>
                    <div class='neomorphic-table col-5'><span>{{ u.nome_func }}</span></div>
                    <div class='neomorphic-table col-2 justify-content-center'><span :class='percColor(u.notaFinal)'>{{ (u.notaFinal)/100 | percent(2) }}</span></div>
                </div>
            </div>
            <vc-pagination v-show="visivel" :source='rankingPagination' @navigate="navigate"></vc-pagination>
        </div>
            <div class='col-5 d-flex'>
                <grafico-radial v-on:parte='grafico' :notas="this.notasGrafico"></grafico-radial>
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
import Select2 from '../shared/Select2.vue'
import GraficoDonuts from '../shared/GraficoDonuts.vue'


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
        GraficoDonuts

    },


    data() {
        return{
            sortProperty: 'notaFinal',
            sortDirection: -1,
            filtro:'',
            visivel:true,
            mensagem_success:'',
            mensagem_error:'',
            date:0,
            paginate:7,
            loading: '',
            page:1,
            selectDate:'',
            orderby:'notaFinal',
            loading2:false,
            rank:[]
        }
    },

    computed:{

        buscaFiltro() {


            if (this.filtro) {
                let exp = new RegExp(this.filtro.trim(), 'i');
                this.visivel = false
                if(this.rank != 'total'){
                     this.visivel = false
                    return this.rank.filter(rank => exp.test([rank.cod_func,rank.nome_func,rank.notaFinal, rank.cod_sup ]));
                }else{
                    return this.ranking.filter(ranking => exp.test([ranking.cod_func,ranking.nome_func,ranking.notaFinal, ranking.cod_sup ]));
                }
            } else {
                if(this.rank != 'total'){
                    this.visivel = false
                    return this.rank;
                }
                this.visivel = true
                return this.rankingPag;
            }

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


        notasGrafico(){

            let cem = this.ranking.filter((i) => i.notaFinal >= 100)
            let noventa = this.ranking.filter((i) => i.notaFinal >= 95 && i.notaFinal < 100)
            let oitenta = this.ranking.filter((i) => i.notaFinal >= 90 && i.notaFinal < 95)
            let setenta = this.ranking.filter((i) => i.notaFinal < 90)

             return [cem.length, noventa.length, oitenta.length, setenta.length]
        },

        ...mapState('ranking', ['ranking', 'rankingPag', 'rankingPagination']),

    },

    methods:{

        ...mapActions('ranking', ['ActionRanking', 'ActionRankingPag']),

        validateSelectionData(selection) {
            this.ActionRanking();
            this.selected = selection;
            this.selectDate = selection.id
            if(this.selectDate){
                try{
                    this.getData(this.selectDate, this.paginate,this.page)
                }catch (err){
                    console.log('Não foi possível carregar a página')
                }finally{
                    this.loading2 = false
                }
            }
            
        },

        grafico(e){

            switch (e) {
                case 100:
                    this.rank = this.ranking.filter((i) => i.notaFinal > 100)
                break;
                    case 90:
                    this.rank = this.ranking.filter((i) => i.notaFinal >= 95 && i.notaFinal <100)
                break;
                case 80:
                    this.rank = this.ranking.filter((i) => i.notaFinal >= 90 && i.notaFinal <95)
                break;
                case 70:
                    this.rank = this.ranking.filter((i) => i.notaFinal < 90)
                break;
                case 0:
                    this.rank = this.ranking.filter((i) => i.notaFinal > 0)
                break;
                default:
                    this.rank = 'total'
            }


        },

        loadingAction(){
            this.loading2 = true
        },

        navigate (page){
            this.page = page
            this.atualizaBasePag(this.selectDate, this.paginate, this.page, this.orderby)
        },

        percColor(u){

             if(u >= 100){
                return `text-blue`
            }else if(u >= 95 && u < 100 ){
                return `text-green`
            }else if (u >=90 && u < 95){
                return `text-orange`
            }else if (u <90){
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

       async atualizaBase(date, orderby){

            try{
                await this.ActionRanking({date,orderby})
            }catch (err){
                console.log('Não foi possível carregar a página')
            }finally{
                this.loading = false
                this.loading2 = false
            }
        },

        async atualizaBasePag(date,paginate,page,orderby){

            try{
                await this.ActionRankingPag({date,paginate,page,orderby})
            }catch (err){
                console.log('Não foi possível carregar a página')
            }finally{
                this.loading = false
                this.loading2 = false
            }
        },

        getData(){
            this.atualizaBase(this.selectDate, this.orderby)
            this.atualizaBasePag(this.selectDate,this.paginate,this.page, this.orderby)
        }
    },

    mounted(){
        this.ActionRanking();
        this.rank = 'total'
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
    padding:0.5rem;
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

