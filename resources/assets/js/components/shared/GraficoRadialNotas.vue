<template>

   <div id="card">
        <div id="chart">
            <apexchart type="radialBar" height="150"  :options="chartOptions" :series="series"></apexchart>
        </div>
    </div>

</template>

<script>

  export default {

        props:['notas', 'peso'],

        data() {
            return {
                series: [this.notas],
                chartOptions: {
                    height: 350,
                        type: 'radialBar',
                        toolbar: {
                            show: true
                    },plotOptions: {
                        radialBar: {
                            startAngle: -135,
                            endAngle: 225,
                            hollow: {
                            margin: 0,
                            size: '70%',
                            background: '#e0eaf5',
                            image: undefined,
                            imageOffsetX: 0,
                            imageOffsetY: 0,
                            position: 'front',
                            dropShadow: {
                                enabled: true,
                                top: 3,
                                left: 0,
                                blur: 4,
                                opacity: 0.24
                            }
                        },
                    track: {
                        background: '#e0eaf5',
                        strokeWidth: '67%',
                        margin: 0, // margin is in pixels
                        dropShadow: {
                            enabled: true,
                            top: -3,
                            left: 0,
                            blur: 4,
                            opacity: 0.35
                        }
                    },

                    dataLabels: {
                    show: true,
                    name: {
                        offsetY: -10,
                        show: true,
                        color: '#888',
                        fontSize: '15px'
                    },
                    value: {
                        formatter: function(val) {
                        return parseFloat(val.toFixed(2));
                        },
                        color: '#111',
                        fontSize: '20px',
                        show: true,
                    }
                    }
                }
                },
                fill: {
                    type: 'gradient',
                    shade: 'dark',
                    shadeIntensity: 0.8,
                    type: 'horizontal',
                    opacityFrom: 1,
                    opacityTo: 1,
                    colors: [function({ value }) {
                        if(value < 90) {
                            return '#d32f2f'
                        } else if (value >= 90 && value < 95) {
                            return '#ff8f00'
                        }else if (value >= 95 && value < 100) {
                            return '#009688'
                        }else {
                            return '#0288d1'
                        }
                    }],
                },
                stroke: {
                lineCap: 'round'
                },
                labels: [`Peso ${this.peso}`],

            }
        }
    }
}

</script>

<style scoped>

</style>
