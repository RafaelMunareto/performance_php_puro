


<div class='d-flex justify-content-around mb-5 flex-wrap height-100'>

    <div id='cards-resultado' class='neomorphic-card borderRadius-20 d-flex justify-content-around flex-column mb-5 height-100'>
        <h4 class="text-uppercase neomorphic-text-gray padding-1">SPRINTS</h4>
        @foreach($sprint as $linha)
            <div class='neomorphic-conc borderRadius-20 padding-07 margin-05 text-center'>
                <div class='d-flex justify-content-between align-center'>
                    <span class='neomorphic-text-black text-center text-uppercase size70 padding-05'>{{$linha->nome_item}}</span>
                    <span class='color-text-txt text-right size90 text-right padding-05'>{{number_format($linha->perc,2)}}</span>
                    <span class='padding-1'>
                        <li class="icon-item margin-0 padding-0 ">
                            <a href="/dashboard_adm/visaoTotal/propriedade/{{$linha->cod_item}}/{{$dta}}?cod_func={{$cod_func}}" class="icon-link borderRadius-10 borderRadius-10 padding-05 neomorphic-text-blue animated-bounce-buttom" title="Propriedades">
                                <i class="fas fa-ellipsis-h"></i>
                            </a>
                        </li>
                    </span>
                </div>
                <div class='neomorphic-conc borderRadius-20 margin-05'>
                    <div class="back">
                        <div id='progress' class="progress soft ">
                            <span id='{{number_format($linha->perc,2)}}' class='color-attr text-white align-middle text-center animated fadeInLeft'></span>
                        </div>
                    </div>
                </div>
                <span class='d-flex justify-content-end size65 text-uppercase mr-2'> peso {{$linha->peso}}</span>
            </div>
        @endforeach
    </div>

    <div id='cards-resultado'  class='neomorphic-card borderRadius-20 d-flex justify-content-around flex-column mb-5 height-100'>
        <h4 class="text-uppercase neomorphic-text-gray padding-1">PRIORITÁRIOS</h4>
        @foreach($prioritario as $linha)
            <div class='neomorphic-conc borderRadius-20 padding-07 margin-05 text-center'>
                <div class='d-flex justify-content-between align-center'>
                    <span class='neomorphic-text-black text-center text-uppercase size70 padding-05'>{{$linha->nome_item}}</span>
                    <span class='color-text-txt text-right size90 text-right padding-05'>{{number_format($linha->perc,2)}}</span>
                    <span class='padding-1'>
                        <li class="icon-item margin-0 padding-0 ">
                            <a href="/dashboard_adm/visaoTotal/propriedade/{{$linha->cod_item}}/{{$dta}}?cod_func={{$cod_func}}" class="icon-link borderRadius-10 borderRadius-10 padding-05 neomorphic-text-blue animated-bounce-buttom" title="Propriedades">
                                <i class="fas fa-ellipsis-h"></i>
                            </a>
                        </li>
                    </span>
                </div>
                <div class='neomorphic-conc borderRadius-20 margin-05'>
                    <div class="back">
                        <div id='progress' class="progress soft ">
                            <span id='{{number_format($linha->perc,2)}}' class='color-attr text-white align-middle text-center animated fadeInLeft'></span>
                        </div>
                    </div>
                </div>
                <span class='d-flex justify-content-end size65 text-uppercase mr-2'> peso {{$linha->peso}}</span>
            </div>
        @endforeach
    </div>

    <div id='cards-resultado' class='neomorphic-card borderRadius-20 d-flex justify-content-around flex-column mb-5 height-100'>
        <h4 class="text-uppercase neomorphic-text-gray padding-1">DIRECIONADORES</h4>
        @foreach($direcionador as $linha)
            <div class='neomorphic-conc borderRadius-20 padding-07 margin-05 text-center'>
                <div class='d-flex justify-content-between align-center'>
                    <span class='neomorphic-text-black text-center text-uppercase size70 padding-05'>{{$linha->nome_item}}</span>
                    <span class='color-text-txt text-right size90 text-right padding-05'>{{number_format($linha->perc,2)}}</span>
                    <span class='padding-1'>
                        <li class="icon-item margin-0 padding-0 ">
                            <a href="/dashboard_adm/visaoTotal/propriedade/{{$linha->cod_item}}/{{$dta}}?cod_func={{$cod_func}}" class="icon-link borderRadius-10 borderRadius-10 padding-05 neomorphic-text-blue animated-bounce-buttom" title="Propriedades">
                                <i class="fas fa-ellipsis-h"></i>
                            </a>
                        </li>
                    </span>
                </div>
                <div class='neomorphic-conc borderRadius-20 margin-05'>
                    <div class="back">
                        <div id='progress' class="progress soft ">
                            <span id='{{number_format($linha->perc,2)}}' class='color-attr text-white align-middle text-center animated fadeInLeft'></span>
                        </div>
                    </div>
                </div>
                <span class='d-flex justify-content-end size65 text-uppercase mr-2'> peso {{$linha->peso}}</span>
            </div>
        @endforeach
    </div>

</div>
