@extends('layouts.basic')
@section('title', 'Simulador')
@section('conteudo')
@section('titulo') SIMULADOR @foreach($func as $linha) {{$linha->nome}} - {{$linha->cod_func}} @endforeach @endsection

</div>

@section('navgation')

    <div class='d-flex'>
        <div class='neomorphic-conc borderRadius-10 padding-05 d-flex flex-column container align-center size80 mr-2'>
            <label for='trava' class='mr-1'>TRAVA DOS ITENS </label>
            <input class='neomorphic-input borderRadius-10 padding-05 col-5 text-center' id='trava' value='120'>
        </div>
        <a href='/dashboard_adm/visaoTotal/{{$dta}}?cod_func={{$cod_func}}' class='d-flex justify-content-end mr-3 height-100'>
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
            </div>
        </a>

    </div>


@endsection


<div id='mobile'>

    <div class="btnSupEsquerdo">
        <a href="#top" class="glyphicon glyphicon-chevron-up">
            <button class="neomorphic-buttom padding-1 borderRadius-50 btnPrincipal text-green back-to-top" name="3" >
                <i class="fa fa-arrow-up"></i>
            </button>
        </a>
    </div>

    <div class='d-flex flex-column mt-3 margin-1'>
        <a href='/dashboard_adm/visaoTotal/{{$dta}}?cod_func={{$cod_func}}'>
            <div class='padding-2 borderRadius-10 neomorphic-card margin-1 animated-bounce-buttom'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
            </div>
        </a>
    </div>

</div>



<div class='d-flex justify-content-around flex-wrap'>
    @include('dashboard.simulador.notas')
</div>


<div class='d-flex justify-content-around mb-5 ml-3 neomorphic-div flex-wrap'>
    @include('dashboard.simulador.resultado', compact('direcionadorCount'))
</div>




@endsection
