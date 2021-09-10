
<canvas id="myChart2" style='width:100%; height:30vh' class='margin-1' ></canvas>

<script>
  var Chart2 = document.getElementById('myChart2').getContext('2d');

  var chart = new Chart(Chart2, {

    type: 'line',
    data: {
        labels:[
            @foreach($meuResult_graf as $linha)
                '{{$linha->data}}',
            @endforeach
        ],
      datasets: [{
        label: "OBJETIVO",
        backgroundColor: "#0288d1",
        pointBorderColor: "#0288d1",
        borderColor: '#0288d1',
        borderWidth: 2,
        pointBorderColor: false,
        data: [
            @foreach($meuResult_graf as $linha)
                {{100.00}},
            @endforeach
        ],
        fill: false,
        lineTension: .4,
      }, {
        label: "MEU RESULTADO",
        fill: false,
        lineTension: .4,
        startAngle: 2,
        data: [
            @foreach($meuResult_graf as $linha)
                {{number_format($linha->notaFinal,2)}},
            @endforeach
        ],
        backgroundColor: "#009688",
        pointBorderColor: "#009688",
        borderColor: '#009688',
        borderWidth: 2,
        showLine: true,
      }, {
        label: "TOP 1" ,
        fill: false,
        lineTension: .4,
        startAngle: 2,
        data: [
            @foreach($top1_graf as $linha)
                {{number_format($linha->notaFinal,2)}},
            @endforeach
        ],
        backgroundColor: "#ff8f00",
        pointBorderColor: "#ff8f00",
        borderColor: '#ff8f00',
        borderWidth: 2,
        showLine: true,
      }]
    },

    // Configuration options
    options: {
      responsive: false,
      title: {
        display: false
      },
      legend: {
        display: false
      },
      tooltips:{
          mode:'index',
          intersect:false,
      },
      animationSteps: 60,
      animation:{
          duration:'3000',
      },
      hover:{
          mode:'nearest',
          intersect:true,
      },
      layout:{
          padding:{
              left:4,
              right:0,
              top:0,
              bottom:0
          }
      },
      scales:{
          xAxes:[{
                gridLines: {
                    display:false
                },
                display:true,
                scaleLabel:{
                  display:false,
                  labelString:'Data'
              }
          }],
          yAxes:[{
                gridLines: {
                    display:false
                },
                display:true,
                scaleLabel:{
                    display:false,
                    labelString:'%'
              },
          }]
      }
    }
  });

</script>
