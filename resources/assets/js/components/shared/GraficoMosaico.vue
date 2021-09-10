<template>

    <div id="chart" >
        <apexchart type="heatmap" height="450" :options="chartOptions" :series="series"></apexchart>
    </div>

</template>

<script>

  export default {

        data() {
            return {
                series: [
                    {
                        name: ['jan'],
                        data: [70]
                    },
                    {
                        name: ['jan'],
                        data: [80]
                    },
                    {
                        name: ['jan'],
                        data: [90]
                    },
                     {
                        name: ['jan'],
                        data: [70]
                    },
                    {
                        name: ['jan'],
                        data: [80]
                    },
                    {
                        name: ['jan'],
                        data: [90]
                    },
                     {
                        name: ['jan'],
                        data: [70]
                    },
                    {
                        name: ['jan'],
                        data: [80]
                    },
                    {
                        name: ['jan'],
                        data: [90]
                    },
                     {
                        name: ['jan'],
                        data: [70]
                    },
                    {
                        name: ['jan'],
                        data: [80]
                    },
                    {
                        name: ['jan'],
                        data: [90]
                    },

                ],
                chartOptions: {
                    chart: {
                        height: 450,
                        type: 'heatmap',
                    },
                    dataLabels: {
                        enabled: false
                    },
                    plotOptions: {
                        heatmap: {
                            shadeIntensity: 1,
                            radius: 2,
                            reverseNegativeShade: false,
                            distributed: false,
                            useFillColorAsStroke: false,
                            colorScale: {
                                ranges: [
                                    {
                                        from: 99.999,
                                        to: 100000,
                                        name: 'AP',
                                        color: '#0288d1',
                                        foreColor: '#0288d1'
                                    },
                                    {
                                        from: 90,
                                        to: 99.999,
                                        name: '90% e 100',
                                        color: '#009688',
                                        foreColor: '#0288d1',
                                    },
                                    {
                                        from: 80,
                                        to: 89.999,
                                        name: '80% e 90%',
                                        color: '#ff8f00'
                                    },
                                    {
                                        from: -1000,
                                        to: 79.9999,
                                        name: 'até 80%',
                                        color: '#d32f2f'
                                    }
                                ]
                            }
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 1
                    },
                    title: {
                        text: 'Nota Final'
                    },

                },

            }
        }
    }

</script>

<style scoped>


</style>

