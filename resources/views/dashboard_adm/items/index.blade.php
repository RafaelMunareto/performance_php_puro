
@extends('layouts.basic')
@section('title', 'Dashboard ITENS')
@section('titulo') DISPERSÃO ITENS - {{Auth::user()->name}}  @endsection

@section('navgation')

    <div class='d-flex'>
        <a href="{{ route('gestao.abertura', $dta) }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
            </div>
        </a>
        <a href="{{ route('gestao.ranking', $dta) }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-medal text-orange"></i>
                <span class='neomorphic-text-black'>ANÁLISE DE RANKING</span>
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
                <vc-gestao_itens :datas='{{ $datas }}'></vc-gestao_itens>
            </div>
        </div>
    </div>


@endsection

@section('navgationM')

    <div class="btnSupEsquerdo">
        <a href="#top" class="glyphicon glyphicon-chevron-up">
            <button class="neomorphic-buttom padding-1 borderRadius-50 btnPrincipal text-green back-to-top" name="3" >
                <i class="fa fa-arrow-up"></i>
            </button>
        </a>
    </div>


    <div class='d-flex flex-column mt-3 mb-4 margin-1'>
        <a href="{{ route('gestao.ranking', $dta) }}">
            <div class='padding-2 borderRadius-10 neomorphic-card mt-3 animated-bounce-buttom'>
                <i class="fa fa-medal text-orange"></i>
                <span class='neomorphic-text-black'>ANÁLISE DE RANKING</span>
            </div>
        </a>
    </div>

    <div class='d-flex justify-content-start'>
        <select name='sl' onchange='window.location="/dashboard_adm/index/" + this.value + "/items?dta=" + this.value'
        class="neomorphic-input col-12 padding-05 borderRadius-10 text-gray text-center font-weigth-600 text-uppercase">
            @foreach($sl as $linha)
                <option @if($dta == $linha->mesN) {{'selected'}} @endif value="{{$linha->mesN}}">{{$buscador->buscaMes($linha->mesN)}}</option>
            @endforeach
        </select>
    </div>

@endsection

@section('conteudoM')

    <div class='d-flex justify-content-around flex-wrap mt-1'>
        <div class='neomorphic-conc borderRadius-20 mt-2 w100 mb-3 text-center d-flex justify-content-center height-100'>
            @include('dashboard_adm.items.grafico_itemsM')
        </div>

        <div class='d-flex justify-content-around mb-5 mt-3 neomorphic-div flex-wrap height-100 size90'>
            @include('dashboard_adm.items.resultado')
        </div>
    </div>

@endsection
