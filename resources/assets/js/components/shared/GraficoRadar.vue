<template>

    <div>
        <div id="chart">
            <apexchart type="radar" height="460" width='600' :options="chartOptions" :series="dataGrafico"></apexchart>
        </div>

            <span class='animated fadeIn text-center d-flex justify-content-center size90 neomorphic-text-black mr-5'>{{ nomeGrafico }}</span>

    </div>

</template>

<script>

  export default {

        props:['data', 'nome'],

        data() {
            return {
               series: [{
                    name: 'Series 1',
                    data: this.dataGrafico,
                }],
                chartOptions: {
                    chart: {
                        height: 550,
                        width: 550,
                        type: 'radar',
                    },
                    dataLabels: {
                        enabled: true
                    },
                    plotOptions: {
                        radar: {
                            size: 200,
                            polygons: {
                                strokeColors: '#f8f8f8',
                                fill: {
                                    colors: ['#e0eaf5', '#fff']
                                }
                            }
                        }
                    },

                    colors: ['#0288d1'],
                    markers: {
                        size: 5,
                        colors: ['#fff'],
                        strokeColor: '#fff',
                        strokeWidth: 4,
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                            return val
                            }
                        }
                    },
                    xaxis: {
                        categories: ['Item', 'Via-Abordado', 'Via-Fechado', 'Via-Aceitos'],
                        labels: {
                                style: {
                                    fontSize: '14px',
                                    colors:'#141414',
                                }
                        }
                    },
                    yaxis: {
                        tickAmount: 9,
                        fontSize: '22px',
                        labels: {
                            formatter: function(val, i) {
                                if (i % 2 === 0) {
                                    return val
                                } else {
                                    return ''
                                }
                            }
                        }
                    }
                },
            }
        },

        computed:{
            dataGrafico(){

                return [{
                    name: 'Series 1',
                    data:  this.data,
                }]

            },

            nomeGrafico(){

                return this.nome

            }
        }

    }

</script>

<style scoped>


</style>
