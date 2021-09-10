@extends('layouts.principal')
@section('title', 'Propriedades')
@section('conteudo')
@section('titulo') PROPRIEDADES - <span class='neomorphic-text-dark'> {{ $nome_item }} </span> @endsection


@section('navgation')

    <div class='d-flex'>
        <a href="{{ route('dashboard', $dta) }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform mr-4'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black'>VOLTAR</span>
            </div>
        </a>
    </div>

@endsection

@section('conteudo')

    <div id='desktop'>
        <div class='d-flex flex-column justify-content-center container-fluid mb-3'>
            <div class='min-height-70vh vue'>
                <vc-propriedades :cod_item='{{ $cod_item }}' :datas='{{ $datas }}'></vc-propriedades>
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

    <div class='d-flex flex-column mt-3 margin-1'>
        <a href="{{ route('dashboard', $dta) }}">
            <div class='padding-2 borderRadius-10 neomorphic-card margin-1 animated-bounce-buttom'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
            </div>
        </a>
    </div>


    <div class='d-flex justify-content-around flex-wrap '>

        <div class='neomorphic-conc borderRadius-20 mb-5 mt-3 text-center d-flex justify-content-center height-100'>
            @include('dashboard.propriedades.grafico')
        </div>

        <div class='d-flex justify-content-around mb-5 mt-3 neomorphic-div flex-wrap height-100'>
            @include('dashboard.propriedades.resultado')
        </div>

    </div>

</div>


@endsection
