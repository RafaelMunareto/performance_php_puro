
<template>

    <div>
        <vc-loading estilo='ranking' v-if='loading'></vc-loading>

        <div v-else id='ranking' class='neomorphic-card borderRadius-10 d-flex justify-content-around flex-column align-middle mb-5 height-100 padding-1' >

            <div class='d-flex justify-content-start align-center'>
                <span class='icon-link borderRadius-10 d-flex flex-column w100'>
                    <h4 class="text-uppercase neomorphic-text-black padding-03 size90">RANKING</h4>
                     <vc-busca-light class='padding-05' v-on:input.native="filtro = $event.target.value" ></vc-busca-light>
                </span>
            </div>



            <div v-show='buscaFiltro' class='row' v-for="u of orderBy(buscaFiltro, sortProperty, sortDirection)" :key="u.id" >

                <div class='d-flex justify-content-center neomorphic-conc size100 borderRadius-10 padding-1 mr-2 mt-2 ml-4 mb-2 col-1'>
                    <span  class='neomorphic-text-black text-bold text-center'>{{ranking.findIndex(x => x.notaFinal === u.notaFinal) + 1}}º</span>
                </div>

                <div class='neomorphic-conc size70 borderRadius-10 padding-1 mr-1 mt-2 ml-1 mb-2 col-7'>
                    <span  class='neomorphic-text-black text-center text-uppercase rank'>{{u.nome_func}}</span>
                </div>

                <div class='neomorphic-conc size80 borderRadius-10 padding-1 mr-1 mt-2 ml-1 mb-2 col-2'>
                    <span class='text-center text-blue align-v' :class='percColor(u.notaFinal)'>{{ (u.notaFinal)/100 | percent(2) }}</span>
                </div>
            </div>
            <vc-pagination v-show="visivel" :source='rankingPagination' @navigate="navigate"></vc-pagination>
        </div>

    </div>

</template>

<script>

import Vue2Filters from 'vue2-filters'
import VcPagination from '../shared/Pagination.vue'
import VcButton from '../shared/Button.vue'
import VcBuscaLight from '../shared/BuscaLight.vue'
import VcMensagem from '../shared/Mensagem.vue';
import VcLoading from '../shared/Loading.vue'
import Select2 from '../shared/Select2.vue'
import GraficoDonuts from '../shared/GraficoDonuts.vue'


import { mapState, mapActions, mapGetters } from 'vuex'


export default {

    props:['cod_func'],

    mixins: [Vue2Filters.mixin],

    components:{
        VcPagination,
        VcButton,
        VcBuscaLight,
        VcMensagem,
        VcLoading,
        Select2,
        GraficoDonuts,
    },


    data() {
        return{
            sortProperty: 'notaFinal',
            sortDirection: -1,
            filtro:'',
            visivel:true,
            date:0,
            paginate:10,
            loading: false,
            page:1,
            orderby:'notaFinal',
        }
    },

    computed:{

        buscaFiltro() {


            if (this.filtro) {
                let exp = new RegExp(this.filtro.trim(), 'i');
                this.visivel = false
                return this.ranking.filter(ranking => exp.test([ranking.cod_func,ranking.nome_func,ranking.notaFinal ]));
            } else {
                this.visivel = true
                return this.rankingPag;
            }

        },

        ...mapState('ranking', ['ranking', 'rankingPag', 'rankingPagination']),
        ...mapGetters('ranking', ['notaFinal']),

    },

    methods:{

        ...mapActions('ranking', ['ActionRanking', 'ActionRankingPag']),

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
            }
        },

        async atualizaBasePag(date,paginate,page,orderby){

            try{
                await this.ActionRankingPag({date,paginate,page,orderby})
            }catch (err){
                console.log('Não foi possível carregar a página')
            }finally{
                this.loading = false
            }
        },

        getData(){
            this.atualizaBase(this.date, this.orderby)
            this.atualizaBasePag(this.date,this.paginate,this.page, this.orderby)
        },
    },

}

</script>

<style scoped>


</style>

