<template>

    <div class="padding-05 borderRadius-10 neomorphic-card d-flex align-center mb-1" :class='estiloBotao'>
        <i class="btn-small waves-effect waves-light btn red darken-1 delete neomorphic-text-gray fas fa-search text-gray"></i>
        <input type="text"  placeholder="" class="neomorphic-input borderRadius-5 padding-03"/>
    </div>

</template>

<script>


export default {

    props:['estilo'],

    computed: {

        estiloBotao(){
            if(this.estilo == 'ranking') return 'size80 w100'
             if(this.estilo == 'padrao') return 'col-4'

        }
    }
}

</script>

<style scoped>

</style>
