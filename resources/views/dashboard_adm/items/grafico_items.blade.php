
   <canvas id="myChart_items"  class='padding-1' width="400" height="400"></canvas>


<script>
    var ctx = document.getElementById('myChart_items').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'polarArea',
        data: {
            labels: [70,80, 90,100],
            datasets: [{

                data:[{{$setenta}},{{$oitenta}}, {{$noventa}},{{$cem}}],

                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1
            }],
            legend: {
                display: false
            },
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            scales: {
                xAxes: [{
                    display: false,
                    scaleLabel: {
                        display: false,
                        labelString: 'Data'
                    }
                }],
                yAxes: [{
                    display: false,
                    scaleLabel: {
                        display: false,
                        labelString: '%'
                    }


                }]
            }
        }
    });
</script>
