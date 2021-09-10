import Vue from 'vue';
import Vue2Filters from 'vue2-filters'
import VueResource from 'vue-resource'
import VueSession from 'vue-session'
import store from './store'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import router from './router/index'
import Dropdown from 'vue-simple-search-dropdown';

import VcLogout from './components/auth/logout/Logout.vue'
import VcVinculados from './components/vinculados/vinculados.vue'
import VcVinculacao from './components/vinculacao/vinculacao.vue'
import VcAtualizacao from './components/atualizacao/atualizacao.vue'
import VcLogin from './components/auth/login/Login.vue'
import VcEquipe from './components/equipe/Equipe.vue'
import VcItens from './components/itens/Itens.vue'
import VcGestao_ranking from './components/gestao_ranking/Gestao_ranking.vue'
import VcGestao_itens from './components/gestao_itens/Gestao_itens.vue'
import VueApexCharts from 'vue-apexcharts'
import VcRanking from './components/ranking/Ranking.vue'
import VcPropriedades from './components/propriedades/Propriedades.vue'
import VcGestao_mosaico from './components/gestao_mosaico/Gestao_mosaico.vue'
import VcItensdash from './components/itensdash/Itensdash.vue'
import VcNotas from './components/notas/Notas.vue'
import VcProd from './components/prod/Prod.vue'
import VueMultiselect from 'vue-multiselect'


Vue.use(VueSession)
Vue.use(Vue2Filters)
Vue.use(VueResource)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(Dropdown);
Vue.component('apexchart', VueApexCharts)
Vue.component('multiselect', VueMultiselect)


new Vue({
    el:".vue",
    store,
    router,
    components:{
        VcVinculados,
        VcVinculacao,
        VcLogin,
        VcLogout,
        VcEquipe,
        VcItens,
        VcAtualizacao,
        VcGestao_itens,
        VcGestao_ranking,
        VcRanking,
        VcPropriedades,
        VcItensdash,
        VcNotas,
        VcProd,
        VcGestao_mosaico
    },

})



