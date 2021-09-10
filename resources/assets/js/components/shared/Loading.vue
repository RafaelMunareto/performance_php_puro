<template>

     <div :class='estiloBotao'  class="text-center min text-primary my-10 neomorphic-card borderRadius-10 padding-2 col-2 animated bounceIn center">
        <b-spinner class="align-middle "></b-spinner>
        <strong>Carregando...</strong>
    </div>

</template>

<script>
export default {
    props:['estilo'],

    computed:{
        estiloBotao(){
              if(this.estilo == 'ranking') return 'col-12'
              if(this.estilo == '') return 'padding-05 margin-left-1'
        }

    }

}
</script>

<style scoped>

.min{
    min-width: 12rem;
}
</style>
