
@foreach($notas as $linha)
    <div id='cars-notas' class='neomorphic-card padding-1 margin-2 borderRadius-20 d-flex flex-column text-center animated flipInX'>
        <span class='size120 font-weight-bold neomorphic-text-gray '>NOTA FINAL</span>
        <span class='size150 color-text-txt font-weight-500 mt-3'>{{number_format($linha->notaFinal,2)}}</span>
    </div>

    <div id='cars-notas' class='neomorphic-conc padding-1 margin-2 borderRadius-20 d-flex flex-column text-center animated flipInX'>
        <span class='size120 font-weight-bold neomorphic-text-gray'>SPRINTS</span>
        <span class='size150 neomorphic-text-black font-weight-500 mt-3'>+{{$linha->notaSprint}}</span>
    </div>

    <div id='cars-notas' class='neomorphic-conc padding-1 margin-2 borderRadius-20 d-flex flex-column text-center animated flipInX'>
        <span class='size120 font-weight-bold neomorphic-text-gray'>PRIORITÁRIOS</span>
        <span class='size150 color-text-txt font-weight-500 mt-3'>{{number_format($linha->notaPrioritario,2)}}</span>
    </div>

    <div id='cars-notas' class='neomorphic-conc padding-1 margin-2 borderRadius-20 d-flex flex-column text-center animated flipInX'>
        <span class='size120 font-weight-bold neomorphic-text-gray'>DIRECIONADORES</span>
        <span class='size150 color-text-txt font-weight-500 mt-3'>{{number_format($linha->notaDirecionador,2)}}</span>
    </div>
@endforeach

