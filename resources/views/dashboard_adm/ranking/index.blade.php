
@extends('layouts.basic')
@section('title', 'Dashboard RANKING')
@section('conteudo')
@section('titulo') ANÁLISE DE RANKING - {{Auth::user()->name}} @endsection


@section('navgation')

    <div class='d-flex'>
        <a href="{{ route('gestao.abertura', $dta) }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
            </div>
        </a>
        <a href='/dashboard_adm/index/{{$dta}}/items?dta={{$dta}}'>
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-chart-area text-green"></i>
                <span class='neomorphic-text-black'>DISPERSÃO POR ITENS</span>
            </div>
        </a>
        <a href="{{ route('gestao.prod', $dta) }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-industry"></i>
                <span class='neomorphic-text-black'>ANÁLISE DE PRODUÇAO</span>
            </div>
        </a>
    </div>

@endsection

@section('conteudo')

    <div id='desktop'>
        <div class='d-flex flex-column justify-content-center container-fluid mb-3'>
            <div class='min-height-70vh vue'>
                <vc-gestao_ranking :datas='{{ $datas }}'></vc-gestao_ranking>
            </div>
        </div>
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

    <div class='d-flex flex-column mt-3 mb-4 margin-1'>
        <a href='/dashboard_adm/index/{{$dta}}/items?dta={{$dta}}'>
            <div class='padding-2 borderRadius-10 neomorphic-card mt-3 animated-bounce-buttom'>
                <i class="fa fa-chart-area text-green"></i>
                <span class='neomorphic-text-black'>DISPERSÃO POR ITENS</span>
            </div>
        </a>
    </div>

    <div class='d-flex justify-content-center'>
        <select name='sl' onchange='window.location="/dashboard_adm/index" + this.value'
        class="neomorphic-input margin-05 col-12 padding-05 borderRadius-10 text-gray text-center font-weigth-600 text-uppercase">
            @foreach($sl as $linha)
                <option @if($dta == $linha->mesN) {{'selected'}} @endif value="/{{$linha->mesN}}">{{strftime('%B', strtotime($linha->mes))}}</option>
            @endforeach
        </select>
    </div>

</div>

<div class='d-flex justify-content-around flex-wrap mt-1'>
    <div class='neomorphic-conc borderRadius-20 margin-1 mb-5 ml-1 mr-1 text-center d-flex justify-content-center height-100'>
        @include('dashboard_adm.ranking.grafico_ranking')
    </div>

    <div class='d-flex justify-content-end mb-5 mt-3 neomorphic-div flex-wrap height-100 size90 align-center'>
        @include('dashboard_adm.ranking.resultado')
    </div>
</div>

@endsection
