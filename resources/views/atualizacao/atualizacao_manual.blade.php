@extends('layouts.basic')
@section('title', 'At.-manual')
@section('titulo') ATUALIZAÇÃO MANUAL - {{Auth::user()->name}} @endsection

@section('navgation')

    <div class='d-flex'>

        <a href="{{ route('adm') }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
            </div>
        </a>

        <a href="{{ route('importar') }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-sync text-orange"></i>
                <span class='neomorphic-text-black'>AT AUTOMÁTICA</span>
            </div>
        </a>

    </div>

@endsection

@section('conteudo')

    <div id='desktop' >
        <div class='container-fluid vue min-height-70vh ml-4'>
            <vc-atualizacao></vc-atualizacao>
        </div>
    </div>

@endsection


@section('navgationM')

    <div class='d-flex flex-column container'>

        <div class="btnSupEsquerdo">
            <a href="#top" class="glyphicon glyphicon-chevron-up">
                <button class="neomorphic-buttom padding-1 borderRadius-50 btnPrincipal text-green back-to-top" name="3" >
                    <i class="fa fa-arrow-up"></i>
                </button>
            </a>
        </div>

        <a href="{{ route('adm') }}">
            <div class='padding-2 borderRadius-10 neomorphic-card mb-4 animated-bounce-buttom'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black text-black font-weight-500'>VOLTAR</span>
            </div>
        </a>

        <form method='POST' action='/atualizacao_manual/{{$id}}/nova_data'>
            @csrf
            @foreach($atualizacao as $linha)
                <input class='display-none' name='cod_func[]' value='{{$id}}'>
                <input class='display-none' name='nome_func[]' value='{{$linha->nome_func}}'>
                <input class='display-none' name='cod_item[]' value={{$linha->cod_item}}>
                <input class='display-none' name='nome_item[]' value='{{$linha->nome_item}}'>
                <input class='display-none' name='categoria[]' value='{{$linha->categoria}}'>
                <input class='display-none' name='obj[]' value='{{$linha->obj}}'>
                <input class='display-none' name='rlz[]' value='{{0}}'>
                <input class='display-none' name='peso[]' value='{{$linha->peso}}'>
                <input class='display-none' name='pontos[]' value='{{0}}'>
                <input class='display-none' name='perc[]' value='{{$linha->perc}}'>
                <input class='display-none' name='adm_id[]' value='{{$linha->adm_id}}'>
                <input class='display-none' name='data[]' value='{{$data}}'>
            @endforeach
            <button type='submit' class='neomorphic-buttom padding-2 col-12 borderRadius-10 buttonTransform text-green text-left'><i class="fas fa-plus-square text-green"></i> NOVO DIA </button>
        </form>

        <form method='POST' action='/at_manual/excluirDia/{{$dtaDelete}}'>
            @csrf
            <button type='submit' class='neomorphic-buttom padding-2 col-12 borderRadius-10 buttonTransform text-red mt-3 mb-3 text-left'>
                <i class="fas fa-trash text-red"></i> EXCLUIR DIA
            </button>
        </form>

        <a href="{{ route('importar') }}">
            <div class='padding-2 borderRadius-10 neomorphic-card mb-4 animated-bounce-buttom'>
                <i class="fa fa-sync text-orange"></i>
                <span class='neomorphic-text-black text-orange font-weight-500'>AT AUTOMÁTICA</span>
            </div>
        </a>

    </div>

@endsection

@section('conteudoM')

    <select name='sl' id='e1' onchange='window.location="/atualizacao_manual/{{$id}}?dta="  + this.value'
        class="neomorphic-input mt-2 padding-1 borderRadius-10 text-gray text-center font-weigth-600 text-uppercase size85">
        @foreach($sl as $linha)
            <option @if($dta == $linha->data) {{'selected'}} @endif value="{{$linha->data}}">{{$linha->data}}</option>
        @endforeach
    </select>

    <select name='validaAdm' onchange='window.location="/atualizacao_manual" + this.value + "?dta={{$dta}}"'
        class="neomorphic-input mt-2 padding-1 borderRadius-10  borderRadius-10 text-gray font-weigth-600 text-uppercase size80">
        <option @if($id == 0) {{'selected'}} @endif value=''>{{'ESCOLHA O FUNCIONÁRIO'}}</option>
        @foreach($func as $linha)
            @if($id == $linha->cod_func)
                <option selected value="/{{$linha->cod_func}}">{{$linha->nome}}</option>
            @else
                <option  value="/{{$linha->cod_func}}">{{$linha->nome}}</option>
            @endif
        @endforeach
    </select>

    <div id="success"></div>
    <div class='d-flex flex-column align-center padding-0 container-fluid margin-0 row'>
        @foreach($atualizacao as $linha)
            <form class='row container-fluid mt-2' method='POST'>
                @csrf
                <label id='dta{{$linha->id}}{{$linha->cod_func}}{{$dta_ajax}}' class='display-none'>{{$dta}}</label>
                <label class='neomorphic-input padding-05 borderRadius-10 col-12 text-center ajax{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}'>
                        {{$linha->nome_func}}</label>
                <label id='id{{$linha->id}}' class='neomorphic-input padding-05 borderRadius-10 col-12 text-center display-none ajax{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}'>
                        {{$linha->cod_func}}</label>
                <label id='cod_func{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}}' class='neomorphic-input padding-05 borderRadius-10 col-12 text-center ajax{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}'>
                        {{$linha->cod_func}}</label>
                <label id='cod_item{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}' class='neomorphic-input padding-05 borderRadius-10 col-12 text-center ajax{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}'>
                    {{$linha->cod_item}}</label>
                <label id='nome_item{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}' class='neomorphic-input padding-05 borderRadius-10 col-12 ajax{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}'>
                    {{$linha->nome_item}}</label>
                <label id='categoria{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}' class='neomorphic-input padding-05 borderRadius-10 col-12 ajax{{$linha->cod_item}}{{$linha->cod_func}}'>
                    {{$linha->categoria}}</label>
                <input id='peso{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}' class='neomorphic-input padding-05 borderRadius-10 col-12 ajax{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}' value='{{$linha->peso}}'>
                <input id='rlz{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}' class='margin-05 padding-05 borderRadius-10 color-dark-gray text-white money col-12 ajax{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}' placeholder='Rlz Acumulado' value='{{$linha->rlz}}'>
            </form>
        @endforeach
    </div>

@endsection

@section('scripts')
@foreach($atualizacao as $linha)
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script>

$(document).ready(function (){

    $(".ajax{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}").blur(function() {
        cod_item = $('#cod_item{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}').text();
        rlz = $('#rlz{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}').val();
        peso = $('#peso{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}').val();
        obj = $('#obj{{$linha->cod_item}}{{$linha->cod_func}}{{$dta_ajax}}').text();
        id = $('#id{{$linha->id}}').text();
        data = $('#dta{{$linha->id}}{{$linha->cod_func}}{{$dta_ajax}}').text();
        $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });

        $.ajax({
            type:"POST",
            data:{
                "cod_item":cod_item,
                "rlz":rlz,
                "id":id,
                "obj":obj,
                "peso":peso,
                'data':data,
            },
            url:"/atualizacao_manual/{{$id}}",
            success:function(data){

            }
        });
    });

});

</script>

@endforeach
