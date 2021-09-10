
<template>

    <div>


        <vc-loading estilo='ranking' v-if='loading'></vc-loading>

        <div v-else>

            <vc-busca id='busca' class='padding-05 mb-3 w100' v-on:input.native="filtro = $event.target.value"></vc-busca>

            <div class='d-flex justify-content-around'>

                <div v-if="this.sprint.length > 0">

                    <div>
                        <h4 class="titulo">SPRINTS</h4>

                        <div :class='Painel'>
                            <div v-for="u of buscaFiltroSprint" :key="u.id" class='painel_int'>
                                <div class='borderRadius-20 margin-05'>
                                    <a v-if='auth' :href="`/propriedade/${u.cod_item}/${dta}`">
                                        <vc-grafico-notas :notas='u.perc' :peso='u.peso'></vc-grafico-notas>
                                    </a>
                                    <a v-else :href="`/dashboard_adm/visaoTotal/propriedade/${ u.cod_item }/${dta}?cod_func=${u.cod_func}`">
                                        <vc-grafico-notas :notas='u.perc' :peso='u.peso'></vc-grafico-notas>
                                    </a>
                                    <span class='neomorphic-text-black text-center text-uppercase size70 padding-05'>{{u.nome_item}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div  v-if='this.prioritario.length > 0' >

                    <div>
                        <h4 class="titulo" >PRIORITARIO</h4>

                        <div :class='Painel'>
                            <div v-for="u of buscaFiltroPrioritario" :key="u.id" class='painel_int'>
                                <div class='borderRadius-20 margin-05'>
                                    <a v-if='auth' :href="`/propriedade/${u.cod_item}/${dta}`">
                                        <vc-grafico-notas :notas='u.perc' :peso='u.peso'></vc-grafico-notas>
                                    </a>
                                    <a v-else :href="`/dashboard_adm/visaoTotal/propriedade/${ u.cod_item }/${dta}?cod_func=${u.cod_func}`">
                                        <vc-grafico-notas :notas='u.perc' :peso='u.peso'></vc-grafico-notas>
                                    </a>
                                    <span class='neomorphic-text-black text-center text-uppercase size70 padding-05'>{{u.nome_item}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div v-if='this.direcionador.length > 0' >

                    <div>
                        <h4 class="titulo">DIRECIONADOR</h4>

                        <div :class='Painel'>
                            <div v-for="u of buscaFiltroDirecionador" :key="u.id" class='painel_int'>
                                <div class='borderRadius-20 margin-05'>
                                    <a v-if='auth' :href="`/propriedade/${u.cod_item}/${dta}`">
                                        <vc-grafico-notas :notas='u.perc' :peso='u.peso'></vc-grafico-notas>
                                    </a>
                                    <a v-else :href="`/dashboard_adm/visaoTotal/propriedade/${u.cod_item}/${dta}?cod_func=${u.cod_func}`">
                                        <vc-grafico-notas :notas='u.perc' :peso='u.peso'></vc-grafico-notas>
                                    </a>
                                    <span class='neomorphic-text-black text-center text-uppercase size70 padding-05'>{{u.nome_item}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

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
import VcGraficoNotas from '../shared/GraficoRadialNotas.vue'


import { mapState, mapActions, mapGetters } from 'vuex'


export default {

    props:['selectdate', 'cod_func', 'dta', 'auth'],

    mixins: [Vue2Filters.mixin],

    components:{
        VcPagination,
        VcButton,
        VcBusca,
        VcMensagem,
        VcLoading,
        Select2,
        VcGraficoNotas,
    },


    data() {

        return{
            filtro:'',
            visivel:true,
            date:0,
            loading: false,
            page:1,
            orderby:'peso'
        }
    },

    computed:{

        buscaFiltroSprint() {

            if (this.filtro) {
                let exp = new RegExp(this.filtro.trim(), 'i');
                this.visivel = false
                return this.sprint.filter(adm => exp.test([adm.cod_item, adm.nome_item,adm.perc,adm.peso]));
            }else{
                return this.sprint
            }
        },

        codFunc(){
            return this.cod_func
        },

        buscaFiltroPrioritario() {

            if (this.filtro) {
                let exp = new RegExp(this.filtro.trim(), 'i');
                this.visivel = false
                return this.prioritario.filter(adm => exp.test([adm.cod_item, adm.nome_item,adm.perc,adm.peso]));
            }else{
                return this.prioritario
            }
        },

        Painel(){
            let prioritario = this.prioritario.length
            if(prioritario > 0){ prioritario = 1}
            let direcionador = this.direcionador.length
            if(direcionador >0){direcionador = 1}{}
            let sprint = this.sprint.length
            if(sprint>0){sprint = 1}

            let total =  prioritario + direcionador + sprint

            if(total == 3){
                return 'painel'
            }else if(total == 2){
                return 'painel_meio'
            }else if(total == 1){
                return 'painel_um_terco'
            }
        },

        buscaFiltroDirecionador() {

            if (this.filtro) {
                let exp = new RegExp(this.filtro.trim(), 'i');
                this.visivel = false
                return this.direcionador.filter(adm => exp.test([adm.cod_item, adm.nome_item,adm.perc,adm.peso]));
            }else{
                return this.direcionador
            }
        },

        ...mapState('adm', ['adm', 'admPag', 'admPagination']),
        ...mapGetters('adm', ['sprint', 'prioritario', 'direcionador']),

    },

    methods:{

        ...mapActions('adm', ['ActionAdm', 'ActionAdmPag', 'ActionAdmDelete']),

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

       async atualizaBase(id,date,orderby){

            try{
                await this.ActionAdm({id,date,orderby})
            }catch (err){
                console.log('Não foi possível carregar a página')
            }finally{
                this.loading = false
            }
        },

        getData(){
            this.atualizaBase(this.cod_func,this.date,this.orderby)
        }
    },

    mounted(){

        // this.getData();

    }
}

</script>

<style scoped>

.painel_um_terco{
    display: flex;
    flex-wrap: wrap;
    width:100%;
    justify-content: center;
}
.painel{
    background-color: #e0eaf5;
    box-shadow: 3px 3px 3px #BECBD8, -1px -1px 10px #e0eaf5;
    border-left: 1px solid #F3F9FF;
    border-top: 1px solid #F3F9FF;
    border-radius:10px;
    display:flex;
    justify-content: space-around;
    flex-direction: column;
    margin-bottom: 2rem;
    margin-right:0.5rem;
    height: 100%;
}

.painel_dois{
    background-color: #e0eaf5;
    box-shadow: 3px 3px 3px #BECBD8, -1px -1px 10px #e0eaf5;
    border-left: 1px solid #F3F9FF;
    border-top: 1px solid #F3F9FF;
    border-radius:10px;
    display:flex;
    justify-content: space-around;
    flex-direction: column;
    margin-bottom: 2rem;
    margin-right:0.5rem;
    height: 100%;
}

.titulo{
    background-color: #e0eaf5;
    box-shadow: 3px 3px 3px #BECBD8, -1px -1px 10px #e0eaf5;
    border-left: 1px solid #F3F9FF;
    border-top: 1px solid #F3F9FF;
    border-radius:10px;
    padding:0.7rem;
    border-radius:10px;
    font-size:90%;
    margin-left: 0.4rem;
    margin-right:0.4rem;
    margin-top:0.3rem;
    margin-bottom:0.3rem;
}

.painel_int{
    box-shadow:  inset 2px 2px 5px #BECBD8, inset -5px -5px 10px #e0eaf5;
    border-radius:10px;
    padding:1rem;
    text-align: center;
    min-width: 14rem;
    margin: 0.2rem;
    height: 100%;

}

#busca{
    min-width: 100%;
}
</style>

