<template>

    <div id="chart" >
            <apexchart type="donut" width="450" @click='serie' :options="chartOptions" :series="this.notas"></apexchart>
    </div>

</template>

<script>

  export default {

        props:['notas'],

        data() {
            return {
                series: [],
                graficoValue:'',
                chartOptions: {
                    chart: {
                        width: 380,
                        type: 'donut',
                        events: {
                            click: function(event, chartContext, config) {
                                this.serie()

                            }
                        }
                    },
                    dataLabels: {
                        enabled: true
                    },
                    fill: {
                        type: 'gradient',
                    },
                    labels: ['AP', 'entre 95% e AP', 'entre 90% e 95%', 'menor que 90%'],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                            width: 200
                            },
                            legend: {
                            position: 'bottom'
                            }
                        }
                    }]
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

