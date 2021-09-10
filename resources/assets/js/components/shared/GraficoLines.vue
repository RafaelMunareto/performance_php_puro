<template>

     <div id="chart">
        <apexchart type="line" height="350" :options="chartOptions" :series="wrapperMyText"></apexchart>
    </div>


</template>

<script>
import { mapState, mapActions, mapGetters } from 'vuex'

  export default {

        props:['dates', 'notagrafico'],

        data() {
            return {
                series: [{
            name: 'Nota Final',
            data: this.notagrafico,
          }],
          chartOptions: {
            chart: {
              height: 350,
              type: 'line',
            },
            stroke: {
              width: 7,
              curve: 'smooth'
            },
            xaxis: {
              type: 'date',
              categories: this.dates,
            },
            title: {
              text: 'Histórico',
              align: 'left',
              style: {
                fontSize: "16px",
                color: '#666'
              }
            },
            fill: {
              type: 'gradient',
              gradient: {
                shade: 'dark',
                gradientToColors: [ '#FDD835'],
                shadeIntensity: 1,
                type: 'horizontal',
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100, 100, 100]
              },
            },
            markers: {
              size: 4,
              colors: ["#FFA41B"],
              strokeColors: "#fff",
              strokeWidth: 2,
              hover: {
                size: 7,
              }
            },
            yaxis: {
              min: 0,
              max: 200,
              title: {
                text: 'Notas Finais',
              },
            }
          },

        }

        },

        computed: {
                wrapperMyText: {
                get() { return [{
                                name: 'Nota Final',
                                data: this.notagrafico,
                            }]},
                set(v) { this.$emit('update:notagrafico', v);}
                }
            }

    }


</script>

<style scoped>


</style>
