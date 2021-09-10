
<template>

    <div class='d-flex align-start flex-column container-fluid'>

        <vc-loading v-if='loading' class='mb-4' estilo='estilo'></vc-loading>

        <div v-else>

            <div class='d-flex justify-content-between margin-top-1rem-'>

                <span v-if='this.title || this.data'><h2  class='neomorphic-text-black text-uppercase ml-3 w-70 size130'>{{ col }}º - {{ title }} {{ dataLaravel }}</h2></span>
                <span v-else ><h2 class='neomorphic-text-black text-uppercase ml-3 w-70 size130'>{{ ranking_col_computed }}º - {{ cod }} {{ nome_func }} - {{ dataprop  }}</h2></span>

                <a v-if="auth" :href="`/simulador/${dta}?cod_func=${codFunc}`" title="SIMULADOR">
                    <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                        <i class="fa fa-calculator text-green"></i>
                        <span class='neomorphic-text-black'>SIMULADOR</span>
                    </div>
                </a>

                <a v-else :href="`/dashboard_adm/visaoTotal/simulador/${dta}?cod_func=${codFunc}`" title="SIMULADOR">
                    <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                        <i class="fa fa-calculator text-green"></i>
                        <span class='neomorphic-text-black'>SIMULADOR</span>
                    </div>
                </a>


            </div>

            <div class='d-flex justify-content-start mb-4'>
                <div class='d-flex neomorphic-card mb-2 padding-05 borderRadius-10'>
                    <i class="btn-small waves-effect waves-light btn red darken-1 delete neomorphic-text-gray fas fa-user-alt text-gray"></i>
                    <select2
                        @ativado='loadingAction()'
                        :options="getSelectFunc"
                        v-on:selected="validateSelection"
                        data="dataBig2x"
                        :disabled="false"
                        placeholder="Escolha um funcionário">
                    </select2>
                    <div>
                        <select2
                            @ativado='loadingAction()'
                            :options="getDataSelect"
                            v-on:selected="validateSelectionData"
                            :disabled="false"
                            data='data'
                            placeholder="Escolha uma data">
                        </select2>
                    </div>
                </div>
                <span v-if='loading2' class='d-flex align-center text-blue ml-2'>
                    <b-spinner class="align-middle "></b-spinner>
                <span>
            </div>

            <div class='d-flex justify-content-around mt-2' v-for="u of this.notas" :key="u.id">

                <div id='card' class='neomorphic-card padding-1 margin-1 borderRadius-20 d-flex flex-column text-center animated flipInX'>
                    <span class='size110 font-weight-bold neomorphic-text-black '>NOTA FINAL</span>
                    <span class='size150 color-text-txt font-weight-500 mt-3' :class='percColor(u.notaFinal)'>{{ (u.notaFinal)/100 | percent(2) }}</span>
                </div>

                <div v-if='u.notaSprint' id='card' class='neomorphic-conc padding-1 margin-1 borderRadius-20 d-flex flex-column text-center animated flipInX'>
                    <span class='size110 font-weight-bold neomorphic-text-black'>SPRINTS</span>
                    <span class='size150 neomorphic-text-black font-weight-500 mt-3'>+{{ (u.notaSprint)/100 | percent(2) }}</span>
                </div>

                <div v-if='u.notaPrioritario'  id='card' class='neomorphic-conc padding-1 margin-1 borderRadius-20 d-flex flex-column text-center animated flipInX'>
                    <span class='size110 font-weight-bold neomorphic-text-black'>PRIORITÁRIOS</span>
                    <span class='size150 color-text-txt font-weight-500 mt-3' :class='percColor(u.notaPrioritario)'>{{ (u.notaPrioritario)/100 | percent(2) }}</span>
                </div>

                <div v-if='u.notaDirecionador'  id='card' class='neomorphic-conc padding-1 margin-1 borderRadius-20 d-flex flex-column text-center animated flipInX'>
                    <span class='size110 font-weight-bold neomorphic-text-black'>DIRECIONADORES</span>
                    <span class='size150 color-text-txt font-weight-500 mt-3' :class='percColor(u.notaDirecionador)'>{{ (u.notaDirecionador)/100 | percent(2) }}</span>
                </div>

            </div>

            <div class='mt-3'>
                <grafico-lines :dates='dates' :notagrafico='notagrafico'></grafico-lines>
            </div>
             <div class='d-flex justify-content-around'>
                <div class='d-flex justify-content-around mb-5 mt-3 mr-4 flex-wrap height-100'>
                    <vc-itensdash :cod_func='this.cod' :dta='this.dta' :selectdate='this.data' :auth='auth'></vc-itensdash>
                </div>

                <div class='d-flex justify-content-around mb-5 mt-3 flex-wrap height-100'>
                    <vc-ranking :cod_func='this.cod_func' ></vc-ranking>
                </div>
            </div>

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
import GraficoLines from '../shared/GraficoLines.vue'
import AdmClass from '../classe/Adm_id.js'
import AdmClassNewDia from '../classe/Adm.js'
import AdmNewDia from '../classe/Adm.js'
import moment from 'moment'
import VcItensdash from '../itensdash/Itensdash.vue'
import VcRanking from '../ranking/Ranking.vue'


import { mapState, mapActions, mapGetters } from 'vuex'

export default {
    props:['dataprop', 'cod', 'dta', 'nome_func', 'auth'],
    mixins: [Vue2Filters.mixin],

    components:{
        VcPagination,
        VcButton,
        VcBusca,
        VcMensagem,
        VcLoading,
        Select2,
        GraficoLines,
        VcItensdash,
        VcRanking
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
            orderbyRanking:'notaFinal',
            orderbyAdm:'peso',
            paginate:10,
            loading: true,
            page:1,
            selectDate:this.data,
            selected: { name: null, id: null },
            dataGrafico:[],
            title:'',
            cod_func:'',
            data:'',
            loading2:false,
            col:''
        }
    },

    computed:{

        codFunc(){

            if(this.cod_func){
                return this.cod_func
            }else{
                return this.cod
            }

        },

        dataLaravel(){

            if(this.data){
                return this.data
            }else{
                return this.dataprop
            }
        },


        getDataSelect(){

            var getSelectFunc = this.dataRanking.map( select => {
                return{
                    name: select.data,
                    id: select.data
                }
            })
            return getSelectFunc;
        },

        dates(){
            var dates = this.dataRanking.map( select => {
                return moment(select.data, 'DD-MM-YY').format('DD/MM/YYYY')
            })

            return dates.slice(0, 15);
        },

        notagrafico(){
            var notagrafico = this.notaFinal.map( select => {
               return select.notaFinal
            })

            return notagrafico.slice(0, 15);
        },

        ranking_col_computed(){
            if(this.cod_func){
                let func = this.cod_func
            }else{
                func = this.cod
            }
            let ranking = this.ranking.filter((i) => i.cod_func === func)

            let nota = ''
            ranking.forEach(function(item){
                nota = item.notaFinal
            });

            return (this.ranking.findIndex(x => x.notaFinal === nota) + 1)
        },


        ...mapState('adm', ['adm', 'admPag', 'admPagination']),
        ...mapState('func', ['func', 'funcPag', 'funcPagination']),
        ...mapState('ranking', ['ranking','rankingPag', 'rankingPagination', 'ranking2']),
        ...mapState('auth', ['user']),
        ...mapState('notas', ['notas']),
        ...mapGetters('func', ['getSelectFunc']),
        ...mapGetters('ranking', ['dataRanking', 'notaFinal']),

    },

    methods:{

        ...mapActions('adm', ['ActionAdm', 'ActionAdmPag', 'ActionAdmDelete', 'ActionAdmDeleteData', 'ActionAdmPut', 'ActionAdmSave']),
        ...mapActions('func', ['ActionFunc']),
        ...mapActions('ranking', ['ActionRanking', 'ActionRankingPag','ActionRanking2'],),
        ...mapActions('notas', ['ActionNotas','ActionNotasPut', 'ActionNotasSave']),

        navigate (page){
            this.page = page
            this.atualizaBasePag(this.cod_func, this.selectDate, this.paginate, this.page)
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

        somenteNumeros: function (valor) {
            return (valor + '').replace(/\D+/g, '');
        },
        loadingAction(){
            this.loading2 = true
        },

        async validateSelection(selection) {

            this.selected = selection;
            this.cod_func = selection.id
            this.title = selection.name
            this.ranking_col()

            if(this.cod_func){
                this.atualizaBaseRankingPag(this.dataprop,this.paginate,this.page,this.orderbyRanking)
                this.atualizaBaseRanking(this.dataprop, this.orderbyRanking)
                this.atualizaBaseAdm(this.cod_func,this.dataprop,this.orderbyAdm)
                this.atualizaBaseNotas(this.cod_func, this.dataprop)
                this.ActionRanking2({id:this.cod_func})

            }else if(this.cod_func && this.selectDate){

                this.atualizaBaseRankingPag(this.selectDate,this.paginate,this.page,this.orderbyRanking)
                this.atualizaBaseRanking(this.selectDate, this.orderbyRanking)
                this.atualizaBaseAdm(this.cod_func,this.selectDate,this.orderbyAdm)
                this.atualizaBaseNotas(this.cod_func, this.selectDate)
                this.ActionRanking2({id:this.cod_func})
            }
        },

        ranking_col(){

            let ranking = this.ranking.filter((i) => i.cod_func === this.cod_func)

            let nota = ''
            ranking.forEach(function(item){
                nota = item.notaFinal
            });

            this.col = (this.ranking.findIndex(x => x.notaFinal === nota) + 1)
        },

        async validateSelectionData(selection) {

            this.selected = selection;
            this.selectDate = selection.id
            this.data = this.selectDate
            this.ranking_col()
            if(!this.cod_func){
                this.cod_func = this.cod
                this.title = this.cod + " " + this.nome_func
            }

            this.atualizaBaseRankingPag(this.selectDate,this.paginate,this.page,this.orderbyRanking)
            this.atualizaBaseRanking(this.selectDate, this.orderbyRanking)
            this.atualizaBaseAdm(this.cod_func,this.selectDate,this.orderbyAdm)
            this.atualizaBaseNotas(this.cod_func, this.selectDate)
            this.ActionRanking2({id:this.cod_func})
        },

        async atualizaBaseNotas(id=null, date=null){

            try{
                await this.ActionNotas({id, date})
            }catch($err){
                console.log('erro ao atualizar as notas')
            }finally{
                 this.loading2 = false
            }
        },

         async atualizaBaseRanking(date=null, orderby=null){

            try{
                await this.ActionRanking({date, orderby})
            }catch($err){
                console.log($err)
                console.log('erro ao tualizar o ranking')
            }

        },

        async atualizaBaseRankingPag(date=null, paginate=null, page=null, orderby=null){

            try{
                await this.ActionRankingPag({date,paginate,page,orderby})
            }catch($err){
                console.log($err)
                console.log('erro ao atualizar o ranking pag')
            }
        },

         async atualizaBaseAdm(id=null, date=null, orderby=null){
            try{
                await this.ActionAdm({id, date, orderby})
            }catch($err){
                console.log('erro ao atualizar a base adm')
            }

        },

        async getData(){
             try{
                await this.atualizaBaseRankingPag(this.dataprop,this.paginate,this.page,this.orderbyRanking)
                await this.atualizaBaseRanking(this.dataprop, this.orderbyRanking)
                await this.atualizaBaseAdm(this.cod,this.dataprop,this.orderbyAdm)
                await this.atualizaBaseNotas(this.cod, this.dataprop)
             }catch($err){
                console.log('Não foi possível carregar a página')
            }finally{
                this.loading = false
            }
        },
    },

    created(){
        this.ActionFunc()
        this.getData()
        this.ActionRanking2({id:this.cod})
        this.ranking_col_computed
    },

}

</script>

<style scoped>

#card {
    min-width: 14rem;
}
#painel{
    min-width:268.8px;
}

</style>

