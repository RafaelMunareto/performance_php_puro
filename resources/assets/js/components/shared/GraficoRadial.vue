<template>

    <div id="chart">
        <apexchart type="radialBar"  @click='serie' height="400" width="400" :options="chartOptions" :series="this.notas"></apexchart>
    </div>

</template>

<script>

  export default {

        props:['notas'],

        data() {
            return {
                series: [],
                chartOptions: {
                    chart: {
                        height: 350,
                        type: 'radialBar',
                        events: {
                                click: function(event, chartContext, config) {
                                    this.serie()

                                }
                        }
                    },

                    plotOptions: {
                        radialBar: {
                            dataLabels: {
                                name: {
                                    fontSize: '22px',
                                },
                                value: {
                                    fontSize: '16px',
                                },

                            }
                        },
                    },
                    labels: ['AP', 'entre 95% e AP', 'entre 90% e 95%', 'menor que 90%'],
                },
            }
        },

        methods:{

            serie(u){
                try{
                    if(u.target.attributes.selected.nodeValue == 'true'){

                        switch (u.target.attributes.j.nodeValue) {
                            case '0':
                                this.graficoValue = 100
                            break;
                             case '1':
                                 this.graficoValue = 90
                            break;
                            case '2':
                                this.graficoValue = 80
                            break;
                            case '3':
                                this.graficoValue = 70
                            break;
                            default:
                                this.graficoValue = 0
                        }
                    }else{
                        this.graficoValue = 0
                    }

                }catch($err){
                     this.graficoValue = 'total'
                }

                this.$emit('parte', this.graficoValue)

            }
        },

    }

</script>

<style scoped>


</style>
