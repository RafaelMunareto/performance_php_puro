
<template>

    <div>
        <div class='d-flex align-start flex-column'>
            <div class='d-flex'>
                <vc-busca estilo="padrao" :func='this.func' v-on:input.native="filtro = $event.target.value"></vc-busca>
                <vc-loading v-if='loading' estilo='estilo'></vc-loading>
            </div>
            <div class='d-flex'>
                <div class='d-flex neomorphic-card mb-2 col-4 padding-05 borderRadius-10'>
                    <i class="btn-small waves-effect waves-light btn red darken-1 delete neomorphic-text-gray fas fa-user-alt text-gray"></i>
                    <select2
                        :options="getSelectFunc"
                        v-on:selected="validateSelection"
                        data="dataBig"
                        :disabled="false"
                        placeholder="Escolha um funcionário">
                    </select2>
                    <vc-button v-if='this.selectDate'
                        icone='fas fa-trash text-red animated-bounce-buttom'
                        mensagem="Confirma a exclusão do dia"
                        id='0'
                        @ativado="excluirDia()"
                        :item='this.selectDate'
                        :confirmacao='true'
                        estilo='excluir'>
                    </vc-button>
                    <div @click='atualizaData()'>
                        <select2
                            :options="getDataSelect"
                            v-on:selected="validateSelectionData"
                            :disabled="false"
                            data='data'
                            placeholder="Escolha uma data">
                        </select2>
                    </div>
                     <vc-button v-if='this.cod_func'
                        icone='fas fa-plus text-green animated-bounce-buttom'
                        id='1'
                        mensagem="Confirma a inclusão do dia "
                        @ativado="adicionarDia()"
                        :item='this.novoDia'
                        :confirmacao='true'
                        estilo='adicionarData'>
                    </vc-button>
                </div>
                <vc-mensagem  class='col-6 ml-3' :mensagem_success="mensagem_success" :mensagem_error="mensagem_error"></vc-mensagem>
            </div>
        </div>


        <div class='ml-1'>
            <div class='row'>
                <a href='#' @click="sort($event, 'cod_item')" class='neomorphic-table-thead col-1 margin-05 padding-05 justify-content-center'><div><span>COD ITEM</span></div>
                <a href='#' @click="sort($event, 'nome_item')" class='neomorphic-table-thead col-4'><div ><span>NOME ITEM</span></div></a>
                <a href='#' @click="sort($event, 'categoria')" class='neomorphic-table-thead col-2'><div><span>CATEGORIA</span></div></a>
                <a href='#' @click="sort($event, 'obj')" class='neomorphic-table-thead col-1'><div><span>META</span></div></a>
                <a href='#' @click="sort($event, 'peso')" class='neomorphic-table-thead col-1'><div class='d-flex justify-content-center'><span>PESO</span></div></a>
                <a href='#' @click="sort($event, 'obj')" class='neomorphic-table-thead col-1'><div><span>REALIZADO</span></div></a>
                <a class='col-1'></a>

            </div>

            <div v-for="u of orderBy(buscaFiltro, sortProperty, sortDirection)" :key="u.id"  class='row'>
                <div class='neomorphic-table col-1 justify-content-center'><span >{{ u.cod_item }}</span></div>
                <div class='neomorphic-table col-4'><span >{{ u.nome_item }}</span></div>
                <div class='neomorphic-table col-2'><span >{{ u.categoria }}</span></div>
                <div class='neomorphic-table col-1'><span >{{ format_number(u.obj)}}</span></div>
                <div class='neomorphic-table col-1 justify-content-center'><span >{{ u.peso }}</span></div>
                <div class='neomorphic-table col-1'><input name='cod_item' v-on:change='altera(u, $event)' class='neomorphic-input text-left text-black money'
                id='cod_item' :value="format_number(u.rlz)"></div>
            </div>
        </div>

        <vc-pagination v-show="visivel" :source='this.admPagination' @navigate="navigate"></vc-pagination>

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
import AdmClass from '../classe/Adm_id.js'
import AdmClassNewDia from '../classe/Adm.js'
import AdmNewDia from '../classe/Adm.js'
import NotasClass from '../classe/Notas.js'
import RankingClass from '../classe/Ranking.js'


import { mapState, mapActions, mapGetters } from 'vuex'

export default {

    mixins: [Vue2Filters.mixin],

    components:{
        VcPagination,
        VcButton,
        VcBusca,
        VcMensagem,
        VcLoading,
        Select2
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
            loading: false,
            page:1,
            selectDate:'',
            selected: { name: null, id: null },
            cod_func:'',
            admClass:'',
            novoDia:'',
            timeAciona:'',
        }
    },

    computed:{

        buscaFiltro() {

            if (this.filtro) {
                let exp = new RegExp(this.filtro.trim(), 'i');
                this.visivel = false
                return this.adm.filter(itens => exp.test([itens.cod_item,itens.nome_item,itens.categoria,itens.obj,itens.peso ]));
            } else {
                this.visivel = true
                return this.admPag;
            }
        },

        getDataSelect(){

            var getSelectFunc = this.ranking.map( select => {
                return{
                    name: select.data,
                    id: select.data
                }
            })
            return getSelectFunc;
        },

        ...mapState('adm', ['adm', 'admPag', 'admPagination']),
        ...mapState('func', ['func', 'funcPag', 'funcPagination']),
        ...mapState('ranking', ['ranking']),
        ...mapState('auth', ['user']),
        ...mapState('notas', ['notas']),
        ...mapGetters('func', ['getSelectFunc'])
    },

    methods:{

        ...mapActions('adm', ['ActionAdm', 'ActionAdmPag', 'ActionAdmDelete', 'ActionAdmDeleteData', 'ActionAdmPut', 'ActionAdmSave']),
        ...mapActions('func', ['ActionFunc']),
        ...mapActions('ranking', ['ActionRanking','ActionRankingSave', 'ActionRankingPut'],),
        ...mapActions('notas', ['ActionNotas','ActionNotasPut', 'ActionNotasSave']),

        navigate (page){
            this.page = page
            this.atualizaBasePag(this.cod_func, this.selectDate, this.paginate, this.page)
        },

        format_number(value) {
            return new Intl.NumberFormat().format(value)
        },
        atualizaData(){
              this.ActionRanking({id:this.cod_func})
        },
        diaAtual(){

            let UNIX = Date.now()
            function Format(timestamp, lang) {
            let dateObj = new Date(timestamp)
            return dateObj.toLocaleString(lang, {
                year: '2-digit',
                month: '2-digit',
                day: '2-digit'
            }).replace(/\//g, '/')

        }

            this.novoDia = Format(UNIX, 'pt-BR')
        },

        async adicionarDia(){

            this.loading = true
            let dataAtual = this.novoDia
            let baseND = []
            let baseNDRanking = []
            let save = this.ActionAdmSave
            let saveRanking = this.ActionRankingSave
            let saveNotas = this.ActionNotasSave
            let adm =  this.adm.filter((i) => i.cod_func == this.cod_func)

            let dataCheck =  this.adm.filter((i) => i.data == this.dataAtual)

            if(dataCheck){

                adm.forEach(function(item) {
                    baseND = {
                        cod_func:item.cod_func,
                        nome_func:item.nome_func,
                        cod_item:item.cod_item,
                        nome_item:item.nome_item,
                        categoria:item.categoria,
                        obj:item.obj,
                        rlz:0,
                        peso:item.peso,
                        pontos:0,
                        perc:0,
                        adm_id:item.adm_id,
                        data:dataAtual
                    },

                    baseNDRanking = {
                        cod_func:item.cod_func,
                        nome_func:item.nome_func,
                        notaFinal:0,
                        adm_id:item.adm_id,
                        data:dataAtual
                    },

                    baseNDNotas = {
                        cod_func:item.cod_func,
                        nome_func:item.nome_func,
                        notaSprint:0,
                        notaDirecionador:0,
                        notaPrioritario:0,
                        notaFinal:0,
                        adm_id:item.adm_id,
                        data:dataAtual
                    }
                    save(baseND)
                })
                try{
                    await saveNotas(baseNDNotas)
                    await saveRanking(baseNDRanking)
                }finally{
                    this.loading = false
                    this.mensagem_ok('Novo dia incluído com sucesso!')
                }
            }else{
                this.mensagem_fail('O dia de hoje já foi incluído!')
            }
        },

        async excluirDia(){

            if(!this.selectDate){
                 this.mensagem_fail(`Você deve escolher um dia antes de excluir.`)
            }else{

                try{
                    await this.ActionAdmDeleteData(this.selectDate)
                }catch(err){
                    this.mensagem_fail(`Erro ao excluir o dia ${this.selectDate}!`)
                }finally{
                    this.mensagem_ok(`Dia ${this.selectDate} excluído com sucesso!`)
                    this.ActionRanking({id:this.cod_func})
                    this.getData(this.cod_func, this.selectDate, this.paginate,this.page)
                }
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

        validateSelection(selection) {
            this.selected = selection;
            this.cod_func = selection.id
            if(this.cod_func){
                this.ActionRanking({id:this.cod_func})
                this.ActionNotas({id:this.cod_func, date:this.selectDate})
            }
            if(this.selectDate && this.cod_func){
                this.getData(this.cod_func, this.selectDate, this.paginate,this.page)
            }
          },

        validateSelectionData(selection) {
            this.selected = selection;
            this.selectDate = selection.id

            if(this.selectDate){
                this.getData(this.cod_func, this.selectDate, this.paginate,this.page)
            }
        },

        getDropdownValues(keyword) {

        },

        check(u){
            let check = this.adm.filter((i) => i.cod_item == u.cod_item)
            if(check != ''){
               return 'true'
            }
        },

        mensagem_ok(mensagem){
            this.mensagem_success = mensagem
            setTimeout(function () {this.mensagem_success = ''}.bind(this), 1500)
        },

        mensagem_fail(mensagem){
            this.mensagem_error = mensagem
            setTimeout(function () {this.mensagem_error = ''}.bind(this), 1500)
        },

        async atualizaBase(id, date){
            await this.ActionAdm({id:id, date:date})
            await this.ActionNotas()
            await this.ActionRanking()
        },

        async atualizaBasePag(id,date,paginate,page){
            await this.ActionAdmPag({id:id, date:date, paginate:paginate, page:page})
        },

        async getData(id, date, paginate, page){

            await this.atualizaBase(id,date)
            await this.atualizaBasePag(id,date, paginate, page)
        },

        altera(u, event){

            var evento = event.target.value
            var realizado = evento.replace('.','').replace(',','.');
            let perc = (realizado/u.obj)*100
            if(perc>120){
                perc = 120
            }

            if(perc<0){
                perc = 0
            }
            let pts = (perc*u.peso)/100
            let pontos = pts.toFixed(2)
            var percentual = perc.toFixed(2)
            let admClasse = new AdmClass(u.id,u.cod_func,u.nome_func,u.cod_item,u.nome_item,u.categoria,u.obj,realizado,u.peso,pontos,percentual,u.adm_id,u.data)

            var pesoPrioritario = 0
            let PePrioritario = this.adm.filter((i) => i.categoria == "PRIORITÁRIO")
            PePrioritario.forEach(function(item) {pesoPrioritario += item.peso});

            var pesoDirecionador = 0
            let PeDirecionador = this.adm.filter((i) => i.categoria == "DIRECIONADOR")
            PeDirecionador.forEach(function(item) {pesoDirecionador += item.peso});

            var pontosTotal = 0
            this.adm.forEach(function(item) {pontosTotal += item.pontos});

            var pontosSprint = 0
            let PoSprint = this.adm.filter((i) => i.categoria == "SPRINT")
            PoSprint.forEach(function(item) {pontosSprint += item.pontos});

            var pontosPrioritario = 0
            let PoPrioritario = this.adm.filter((i) => i.categoria == "PRIORITÁRIO")
            PoPrioritario.forEach(function(item) {pontosPrioritario += item.pontos});

            var pontosDirecionador = 0
            let PoDirecionador = this.adm.filter((i) => i.categoria == "DIRECIONADOR")
            PoDirecionador.forEach(function(item) {pontosDirecionador += item.pontos});

            let nSprint = pontosSprint
            var notaSprint = nSprint.toFixed(2)

            let nPrioritario = (pontosPrioritario/pesoPrioritario)*100
            var notaPrioritario = nPrioritario.toFixed(2)

            let nDirecionador = (pontosDirecionador/pesoDirecionador)*100
            var notaDirecionador = nDirecionador.toFixed(2)
            let nTotal = (((pontosPrioritario + pontosDirecionador)/(pesoDirecionador + pesoPrioritario))*100) + nSprint
            var notaFinal = nTotal.toFixed(2)

            let idNotas = ''
            this.notas.forEach(function(item) {idNotas = item.id});
            let idRanking = ''
            this.ranking.forEach(function(item) {idRanking = item.id});
            let notasClass = new NotasClass(idNotas, u.cod_func, u.nome_func, notaSprint, notaPrioritario, notaDirecionador,notaFinal, u.adm_id, this.selectDate)
            let rankingClass = new RankingClass(idRanking, u.cod_func, u.nome_func, notaFinal, u.adm_id, this.selectDate)

            try{
                this.ActionAdmPut(admClasse)
                this.ActionNotasPut(notasClass)
                this.ActionRankingPut(rankingClass)
            }catch(err){
                this.mensagem_fail(`Erro ao incluir o item ${u.nome_item}!`)
            }finally{
                setTimeout(function () {this.mensagem_ok(`Item ${u.nome_item} atualizado!`)}.bind(this), 1200)
                this.atualizaBasePag(this.cod_func, this.selectDate, this.paginate, this.page)
                this.atualizaBase(this.cod_func, this.selectDate)
            }

        }
    },

    mounted(){
        this.ActionFunc()
        this.diaAtual()
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

