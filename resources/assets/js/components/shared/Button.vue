<template>

    <div>

        <button :class="estiloBotao" data-toggle="modal" :data-target="'#modal' + id" @click="disparaAcao()">
            <i :class="icone"></i>
        </button>

        <div class="modal fade size90" :id="'modal' + id" tabindex="-1" role="dialog" :aria-labelledby="'modal' + id" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content  background">
                <div class="modal-header">
                    <h5 class="modal-title size120" id="exampleModalLongTitle">Confirmação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id='neomorphic-modal'>
                    {{ msg }}
                </div>
                <div class="modal-footer">
                    <button type="button " class="btn btn-secondary size90" data-dismiss="modal">CANCELAR</button>
                    <button type="button" @click='confirma()' data-dismiss="modal" class="btn btn-primary size90">OK</button>
                </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>

export default {

    props:{
        icone: {
            required: true,
            type: String
        },
        confirmacao: {
            required: false,
            type: Boolean
        },
        estilo:{
            required: false,
            type: String
        },
        item:{
            require:false,
            type:String
        },
        mensagem: {
            require:false,
            type:String
        },
        id:{
            require:false
        }
    },

    data(){
        return{
             show: false,
             msg: '',
             confirmado: ''
        }
    },

    methods:{

        disparaAcao(id, msg, confirmado) {
            this.msg =  `${this.mensagem} ${this.item} ?`
        },

        confirma(){
           this.$emit("ativado");
        }
    },

    computed: {
        estiloBotao(){
             if(this.estilo == 'excluir') return 'btn-floating btn-small waves-effect waves-light btn red darken-1 delete'
             if(this.estilo == 'adicionar') return 'btn-floating btn-small waves-effect waves-light btn green adcionar'
             if(this.estilo == 'excluirData') return 'btn-floating btn-small waves-effect waves-light btn red darken-1 delete ml-2'
             if(this.estilo == 'adicionarData') return 'btn-floating btn-small waves-effect waves-light btn green darken-1 adcionar'
        }
    },


}


</script>

<style scoped>

#neomorphic-modal{
    box-shadow:  inset 2px 2px 5px #BECBD8, inset -5px -5px 10px #e0eaf5;
    border-radius: 10px;
    margin:0.5rem;
    font-size:100%;
    vertical-align: middle;
    display: flex;
    align-items: center;
    background:#e0eaf5 !important
}

.background{
    background:#e0eaf5 !important
}

#neomorphic-card{
     background-color: #e0eaf5;
    box-shadow: 10px 10px 20px #BECBD8, -10px -10px 20px #F3F9FF;
}

#neomorphic-buttom {
    border:0;
    background-color: #e0eaf5;
    box-shadow: 10px 10px 20px #BECBD8, -10px -10px 20px #F3F9FF;
    border-left: 1px solid #F3F9FF;
    border-top: 1px solid #F3F9FF;
    transition: all 0.2s ease-in-out;
    cursor: pointer;
    font-weight: 600;
}


</style>
