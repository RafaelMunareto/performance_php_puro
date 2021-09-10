
@extends('layouts.basic')
@section('title', 'Dashboard PROD')
@section('conteudo')
@section('titulo') ANÁLISE DE PRODUÇÃO - {{Auth::user()->name}} @endsection


@section('navgation')


    <div class='d-flex animated fadeIn'>
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
        <a href="{{ route('gestao.ranking', $dta) }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-medal text-orange"></i>
                <span class='neomorphic-text-black'>ANÁLISE DE RANKING</span>
            </div>
        </a>
    </div>


@endsection

@section('conteudo')

    <div id='desktop'>
        <div class='d-flex flex-column justify-content-center container-fluid mb-3'>
            <div class='min-height-70vh vue'>
                <vc-prod></vc-prod>
            </div>
        </div>
    </div>


@endsection

<div id='mobile'>


</div>

@endsection
