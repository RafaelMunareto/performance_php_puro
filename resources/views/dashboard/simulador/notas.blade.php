
@foreach($notas as $linha)
    <div id='cars-notas' class='neomorphic-card padding-1 margin-2 borderRadius-20 d-flex flex-column text-center animated flipInX'>
        <span class='size120 font-weight-bold neomorphic-text-gray '>NOTA FINAL</span>
        <div class='d-flex justify-content-center row'>
            <span class='size150 color-text-txt font-weight-500 col-10 mt-3' id='notaFinal'>{{$linha->notaFinal}}</span>
            <input id='oldNF' class='display-none' value='{{$linha->notaFinal}}'>
            <span class='size70 col-6 borderRadius-5 mt-1' id='difNotaFinal'></span>
        </div>
    </div>


@if($sprintCount >0)
    <div id='cars-notas' class='neomorphic-conc padding-1 margin-2 borderRadius-20 d-flex flex-column text-center animated flipInX'>
        <span class='size120 font-weight-bold neomorphic-text-gray'>SPRINTS</span>
        <div class='d-flex justify-content-center row'>
            <span class='size150 neomorphic-text-black font-weight-500 col-10 mt-3' id='notaSprint'>+{{$linha->notaSprint}}</span>
            <input id='oldS' class='display-none' value='{{$linha->notaSprint}}'>
            <span class='size70 col-6 borderRadius-5 mt-1' id='difSprint'></span>
        </div>
    </div>
@endif
@if($prioritarioCount >0)
    <div id='cars-notas' class='neomorphic-conc padding-1 margin-2 borderRadius-20 d-flex flex-column text-center animated flipInX'>
        <span class='size120 font-weight-bold neomorphic-text-gray'>PRIORITÁRIOS</span>
        <div class='d-flex justify-content-center row'>
            <span class='size150 color-text-txt font-weight-500 col-10 mt-3' id='notaPrioritario'>{{$linha->notaPrioritario}}</span>
            <input id='oldP' class='display-none' value='{{$linha->notaPrioritario}}'>
            <input id='pontoPrioritario' class='display-none' value=''>
            <input id='pesoPrioritario' class='display-none' value=''>
            <span class='size70 col-6 borderRadius-5 mt-1' id='difPrioritario'></span>
        </div>
    </div>
@endif
@if($direcionadorCount >0)
    <div id='cars-notas' class='neomorphic-conc padding-1 margin-2 borderRadius-20 d-flex flex-column text-center animated flipInX'>
        <span class='size120 font-weight-bold neomorphic-text-gray'>DIRECIONADORES</span>
        <div class='d-flex justify-content-center row'>
            <span class='size150 color-text-txt font-weight-500 col-10 mt-3' id='notaDirecionador'>{{$linha->notaDirecionador}}</span>
            <input id='oldD' class='display-none' value='{{$linha->notaDirecionador}}'>
            <input id='pontoDirecionador' class='display-none' value=''>
            <input id='pesoDirecionador' class='display-none' value=''>
            <span class='size70 col-6 borderRadius-5 mt-1' id='difDirecionador'></span>
        </div>
    </div>
@endif
@endforeach

