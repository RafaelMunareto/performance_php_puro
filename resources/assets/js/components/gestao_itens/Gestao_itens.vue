
<template>

    <div class='row ml-4'>

        <div class='col-7'>
            <div>
                <div class='d-flex space-between'>
                    <vc-busca class='col-7' v-on:input.native="filtro = $event.target.value" ></vc-busca>
                    <vc-mensagem  class='col-7 ml-3' :mensagem_success="mensagem_success" :mensagem_error="mensagem_error"></vc-mensagem>
                </div>
                <div class='d-flex'>
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
                    <span v-if='loading2' class='d-flex align-center text-blue ml-2'>
                        <b-spinner class="align-middle "></b-spinner>
                    <span>
                </div>
            </div>

            <div class='ml-3'>
                <div class='row'>
                    <a class='neomorphic-table-thead col-1 text-center'><div><span>COL</span></div></a>
                    <a href='#' @click="sort($event, 'nome_func')" class='neomorphic-table-thead col-1 justify-content-center'><div><span>SUP</span></div>
                    <a href='#' @click="sort($event, 'nome_func')" class='neomorphic-table-thead col-1 justify-content-center'><div><span>COD</span></div>
                    <a href='#' @click="sort($event, 'nome_func')" class='neomorphic-table-thead col-3 justify-content-center'><div><span>NOME FUNC</span></div>
                    <a href='#' @click="sort($event, 'obj')" class='neomorphic-table-thead col-2'><div ><span>OBJETIVO </span></div></a>
                    <a href='#' @click="sort($event, 'rlz')" class='neomorphic-table-thead col-2'><div><span>REALIZADO</span></div></a>
                    <a href='#' @click="sort($event, 'perc')" class='neomorphic-table-thead col-1 text-center'><div><span>%</span></div></a>

                </div>
                <div v-for="u of orderBy(buscaFiltro, sortProperty, sortDirection)" :key="u.id"  class='row'>
                    <div class='neomorphic-table col-1 justify-content-center'><span>{{adm.findIndex(x => x.perc === u.perc) + 1}}º</span></div>
                    <div class='neomorphic-table col-1 justify-content-center'><span>{{ u.cod_sup }}</span></div>
                    <div class='neomorphic-table col-1 justify-content-center'><span>{{ u.cod_func }}</span></div>
                    <div class='neomorphic-table col-3'><span>{{ u.nome_func }}</span></div>
                    <div class='neomorphic-table col-2 size70'><span>{{ u.obj | number('0,0', { thousandsSeparator: '.' })}}</span></div>
                    <div class='neomorphic-table col-2 size70'><span>{{ u.rlz | number('0,0', { thousandsSeparator: '.' }) }}</span></div>
                    <div class='neomorphic-table col-1 justify-content-center'><span :class='percColor(u)'>{{ (u.perc)/100 | percent(2) }}</span></div>
                </div>
            </div>
            <vc-pagination v-show="visivel" :source='admPagination' @navigate="navigate"></vc-pagination>
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
import GraficoRadial from '../shared/GraficoRadial.vue'


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
        GraficoRadial,
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

        buscaFiltro() {

            if (this.filtro) {
                 this.visivel = false
                let exp = new RegExp(this.filtro.trim(), 'i');
                if(this.rank != 'total'){
                     this.visivel = false
                    return this.rank.filter(rank => exp.test([rank.cod_func,rank.nome_func,rank.notaFinal, rank.cod_sup ]));
                }else{
                   return this.adm.filter(adm => exp.test([adm.cod_func,adm.nome_func,adm.obj,adm.rlz,adm.perc,adm.cod_sup ]));
                }
            }else {
                if(this.rank != 'total'){
                    this.visivel = false
                    return this.rank;
                }
                this.visivel = true
                 return this.admPag;
            }

        },

        notasGrafico(){

            let cem = this.adm.filter((i) => i.perc >= 100)
            let noventa = this.adm.filter((i) => i.perc >= 95 && i.perc < 100)
            let oitenta = this.adm.filter((i) => i.perc >= 90 && i.perc < 95)
            let setenta = this.adm.filter((i) => i.perc < 90)
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

        navigate (page){
            this.page = page
            this.atualizaBasePag(this.selectDate, this.paginate, this.page, this.cod_item)
        },

         percColor(u){

            if(u.perc >= 100){
                return `text-blue`
            }else if(u.perc >= 95 && u.perc < 100 ){
                return `text-green`
            }else if (u.perc >=90 && u.perc < 95){
                return `text-orange`
            }else if (u.perc <90){
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

        grafico(e){

            switch (e) {
                case 100:
                    this.rank = this.adm.filter((i) => i.perc > 100)
                break;
                    case 90:
                    this.rank = this.adm.filter((i) => i.perc >= 95 && i.perc <100)
                break;
                case 80:
                    this.rank = this.adm.filter((i) => i.perc >= 90 && i.perc <95)
                break;
                case 70:
                    this.rank = this.adm.filter((i) => i.perc < 90)
                break;
                case 0:
                    this.rank = this.adm.filter((i) => i.perc > 0)
                break;
                default:
                    this.rank = 'total'
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
    margin:0.2rem;
    font-size:75%;
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
    margin:0.2rem;
    padding:0.5rem;
    font-size:80%;
    vertical-align: middle;
}


</style>

