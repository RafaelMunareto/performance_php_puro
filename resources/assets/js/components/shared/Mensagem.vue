<template>
    <div >

    <transition name="slide-fade">
        <div v-show="mensagem_success" class="row borderRadius-10 transition-05" id="alert_box">
            <div class="col s10 m12">
                <div class="neomorphic-conc padding-05 margin-05 borderRadius-10">
                    <div class="row">
                        <div class="col s12 m10">
                            <div class="card-content ml-1">
                                <p class=' margin-0 text-blue text-uppercase size75'>
                                    <i class="fas fa-check-circle text-blue"></i>
                                    {{ mensagem_success }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>

    <transition name="slide-fade">
        <div v-show="mensagem_error" class="row borderRadius-10 transition-05" id="alert_box">
            <div class="col s10 m12">
                <div class="neomorphic-conc padding-05 margin-05 borderRadius-10">
                    <div class="row">
                        <div class="col s12 m10">
                            <div class="card-content ml-1">
                                <p class=' margin-0 text-red text-uppercase size75'>
                                    <i class="fas fa-times text-red"></i>
                                    {{ mensagem_error }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>


    </div>

</template>

<script>
  export default {
    props:{
        mensagem_success:{
            type:String
        },
         mensagem_success:{
            type:String
        },
        mensagem_error:{
            type:String
        }
    },


  }
</script>

<style scoped>

.slide-fade-enter-active {
  transition: all .5s ease;
}
.slide-fade-leave-active {
  transition: all .15s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active em versões anteriores a 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}

.transition-05{
    transition-duration: 0.5s
}

</style>
