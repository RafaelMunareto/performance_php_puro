
<div class='neomorphic-conc d-flex justify-content-around borderRadius-20 neomorphic-div flex-wrap height-100' id="">

    @if($sprintCount >0)
        <div id='cards-resultadoS'  class='neomorphic-card borderRadius-20 d-flex justify-content-around flex-column height-100 mt-4 flex-wrap'>
            <h4 class="text-uppercase neomorphic-text-gray padding-1">SPRINTS</h4>
            @foreach($sprint as $linha)
                <div class='neomorphic-conc borderRadius-20 padding-07 margin-05 text-center'>
                    <div class='d-flex justify-content-between align-center'>
                        <span class='neomorphic-text-black text-center text-uppercase size80 padding-05'>{{$linha->nome_item}}</span>
                        <input class='{{$linha->cod_item}} inputSimulador neomorphic-input borderRadius-10 col-2 size90 text-center padding-05 color-text-val'
                        id='{{'S' . $linha->cod_item}}' data-id='{{$linha->perc}}' value='{{$linha->perc}}'>
                    </div>
                    <div class='neomorphic-conc borderRadius-20 margin-05'>
                        <div class="back">
                            <div id='progress' class="progress soft">
                                <span data-id='{{$linha->perc}}' id='color-with-simulador{{$linha->cod_item}}' class='color-with-simulador color-attr text-white align-middle text-center animated fadeInLeft'></span>
                            </div>
                        </div>
                    </div>
                    <div class='row text-center ml-1 d-flex'>
                        <span class='d-flex justify-content-start size65 text-uppercase col-4'>OBJETIVO</span>
                        <span class='d-flex justify-content-start size65 text-uppercase col-4'>REALIZADO</span>
                        <span class='d-flex justify-content-start size65 text-uppercase col-3'>PESO</span>
                    </div>
                    <div class='row text-center ml-1 d-flex'>
                        <span class='d-flex justify-content-start size65 text-uppercase col-4 money'>{{$linha->obj}}*10</span>
                        <span class='d-flex justify-content-start size65 text-uppercase col-4 money'>{{$linha->rlz}}*10</span>
                        <span id='Peso{{'S'.$linha->cod_item}}' class='d-flex justify-content-start size65 text-uppercase col-3'>{{$linha->peso}}</span>
                    </div>
                </div>
            @endforeach

        </div>
    @endif

@if($prioritarioCount > 0)
    <div id='cards-resultadoS'  class='neomorphic-card borderRadius-20 d-flex justify-content-around flex-column height-100 mt-4 flex-wrap'>

        <h4 class="text-uppercase neomorphic-text-gray padding-1">PRIORITÁRIOS</h4>
        @foreach($prioritario as $linha)
            <div class='neomorphic-conc borderRadius-20 padding-07 margin-05 text-center'>
                <div class='d-flex justify-content-between align-center'>
                    <span class='neomorphic-text-black text-center text-uppercase size80 padding-05'>{{$linha->nome_item}}</span>
                    <input class='{{$linha->cod_item}} inputSimulador neomorphic-input borderRadius-10 col-2 size90 text-center padding-05 color-text-val'
                    id='{{'P' . $linha->cod_item}}' data-id='{{$linha->perc}}' value='{{$linha->perc}}'>
                </div>
                <div class='neomorphic-conc borderRadius-20 margin-05'>
                    <div class="back">
                        <div id='progress' class="progress soft ">
                            <span data-id='{{$linha->perc}}' id='color-with-simulador{{$linha->cod_item}}' class='color-with-simulador color-attr text-white align-middle text-center animated fadeInLeft'></span>
                        </div>
                    </div>
                </div>
                <div class='row text-center ml-1 d-flex'>
                    <span class='d-flex justify-content-start size65 text-uppercase col-4'>OBJETIVO</span>
                    <span class='d-flex justify-content-start size65 text-uppercase col-4'>REALIZADO</span>
                    <span class='d-flex justify-content-start size65 text-uppercase col-3'>PESO</span>
                </div>
                <div class='row text-center ml-1 d-flex'>
                    <span class='d-flex justify-content-start size65 text-uppercase col-4 money'>{{$linha->obj}}*10</span>
                    <span class='d-flex justify-content-start size65 text-uppercase col-4 money'>{{$linha->rlz}}*10</span>
                    <span id='PesoP{{$linha->cod_item}}' class='d-flex justify-content-start size65 col-3 pesoP'>{{$linha->peso}}</span>
                </div>
            </div>
        @endforeach

    </div>

@if($direcionadorCount > 0)
    <div id='cards-resultadoS' class='neomorphic-card borderRadius-20 d-flex justify-content-around flex-column height-100 mt-4 flex-wrap'>

        <h4 class="text-uppercase neomorphic-text-gray padding-1">DIRECIONADORES</h4>
        @foreach($direcionador as $linha)
            <div class='neomorphic-conc borderRadius-20 padding-07 margin-05 text-center'>
                <div class='d-flex justify-content-between align-center'>
                    <span class='neomorphic-text-black text-center text-uppercase size80 padding-05'>{{$linha->nome_item}}</span>
                    <input class='{{$linha->cod_item}} inputSimulador neomorphic-input borderRadius-10 col-2 size90 text-center padding-05 color-text-val'
                    id='{{'D' . $linha->cod_item}}' data-id='{{$linha->perc}}' value='{{$linha->perc}}'>
                </div>
                <div class='neomorphic-conc borderRadius-20 margin-05'>
                    <div class="back">
                        <div id='progress' class="progress soft ">
                            <span data-id='{{$linha->perc}}' id='color-with-simulador{{$linha->cod_item}}' class='color-with-simulador color-attr text-white align-middle text-center animated fadeInLeft'></span>
                        </div>
                    </div>
                </div>
                <div class='row text-center ml-1 d-flex'>
                    <span class='d-flex justify-content-start size65 text-uppercase col-4'>OBJETIVO</span>
                    <span class='d-flex justify-content-start size65 text-uppercase col-4'>REALIZADO</span>
                    <span class='d-flex justify-content-start size65 text-uppercase col-3'>PESO</span>
                </div>
                <div class='row text-center ml-1 d-flex'>
                    <span class='d-flex justify-content-start size65 text-uppercase col-4 money'>{{$linha->obj}}*10</span>
                    <span class='d-flex justify-content-start size65 text-uppercase col-4 money'>{{$linha->rlz }}*10</span>
                    <span id='PesoD{{$linha->cod_item}}' class='d-flex justify-content-start size65 text-uppercase col-3 pesoD'>{{$linha->peso}}</span>
                </div>
            </div>
        @endforeach
    </div>
@endif
</div>


<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
@foreach($total as $linha)
<script>
    $(document).ready(function (){

        $('#color-with-simulador{{$linha->cod_item}}').each(function(){
            var input = $('.{{$linha->cod_item}}').val();
            var perc = input.replace(',','.') * 1;
            if(perc >= 100){
                $(this).addClass('color-blue').removeClass('color-green').removeClass('color-orange').removeClass('color-red');
            }else if(perc>=90 && perc < 100){
                $(this).addClass('color-green').removeClass('color-blue').removeClass('color-orange').removeClass('color-red');
            }else if(perc>=80 && perc < 90){
                $(this).addClass('color-orange').removeClass('color-green').removeClass('color-blue').removeClass('color-red');
            }else if(perc<80){
                $(this).addClass('color-red').removeClass('color-green').removeClass('color-orange').removeClass('color-blue');
            }
            if(perc >= 100){
                perc = 100;
            }else if(perc<0){
                perc = 0
            }
            $(this).animate({ width: perc + '%' }, 'fast');
        });

        $(".{{$linha->cod_item}}").on('input', function(){
            var input = $(this).val();
            var perc = input.replace(',','.') * 1;

            if(perc >= 100){
                $(this).addClass('text-blue').removeClass('text-green').removeClass('text-orange').removeClass('text-red');
            }else if(perc>=90 && perc < 100){
                $(this).addClass('text-green').removeClass('text-blue').removeClass('text-orange').removeClass('text-red');
            }else if(perc>=80 && perc < 90){
                $(this).addClass('text-orange').removeClass('text-green').removeClass('text-blue').removeClass('text-red');
            }else if(perc<80){
                $(this).addClass('text-red').removeClass('text-green').removeClass('text-orange').removeClass('text-blue');
            }

            $('#color-with-simulador{{$linha->cod_item}}').each(function(){
                var input = $('.{{$linha->cod_item}}').val();
                var perc = input.replace(',','.') * 1;
                if(perc >= 100){
                    $(this).addClass('color-blue').removeClass('color-green').removeClass('color-orange').removeClass('color-red');
                }else if(perc>=90 && perc < 100){
                    $(this).addClass('color-green').removeClass('color-blue').removeClass('color-orange').removeClass('color-red');
                }else if(perc>=80 && perc < 90){
                    $(this).addClass('color-orange').removeClass('color-green').removeClass('color-blue').removeClass('color-red');
                }else if(perc<80){
                    $(this).addClass('color-red').removeClass('color-green').removeClass('color-orange').removeClass('color-blue');
                }
                if(perc >= 100){
                    perc = 100;
                }else if(perc<0){
                    perc = 0
                }
                $(this).animate({ width: perc + '%' }, 'slow');
            });

            $('.inputSimulador').on('input', function(){
                $('.color-text-txt').each(function(){
                    var input = $(this).text();
                    var perc = input.replace(',','.') * 1;
                    if(perc >= 100){
                        $(this).addClass('text-blue').removeClass('text-green').removeClass('text-orange').removeClass('text-red');
                    }else if(perc>=90 && perc < 100){
                        $(this).addClass('text-green').removeClass('text-blue').removeClass('text-orange').removeClass('text-red');
                    }else if(perc>=80 && perc < 90){
                        $(this).addClass('text-orange').removeClass('text-green').removeClass('text-blue').removeClass('text-red');
                    }else if(perc<80){
                        $(this).addClass('text-red').removeClass('text-green').removeClass('text-orange').removeClass('text-blue');
                    }
                });
            });

        });
    });
</script>
@endforeach
