@extends('layouts.basic')
@section('title', 'Equipe')
@section('conteudo')
@section('titulo') EQUIPE - {{Auth::user()->name}} @endsection

@section('navgation')

<div class='d-flex'>

    <a href="{{ route('adm') }}">
        <div class='animated-bounce-buttom button-down-basic buttonTransform'>
            <i class="fa fa-arrow-circle-left text-blue"></i>
            <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
        </div>
    </a>
    <a href="{{ route('adm.equipe.adicionar') }}">
        <div class='animated-bounce-buttom button-down-basic buttonTransform'>
            <i class="far fa-plus-square text-green"></i>
            <span class='neomorphic-text-black font-weight-500'>ADICIONAR</span>
        </div>
    </a>

    <div class='d-flex justify-content-start'>
        <a href="{{ route('adm') }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-bullseye neomorphic-text-black padding-1p-right"></i>
                <span class='neomorphic-text-black'>METAS</span>
            </div>
        </a>
        <a href="{{ route('at.manual', 0) }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-exchange-alt neomorphic-text-black padding-1p-right"></i>
                <span class='neomorphic-text-black'>ATUALIZAÇÃO</span>
            </div>
        </a>
    </div>

</div>

@endsection

@section('conteudo')

    <div id='desktop'>
        <div class='d-flex flex-column justify-content-center container mb-3 container-fluid'>
            <div class='min-height-70vh vue'><vc-equipe></vc-equipe></div>
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

    <div class='d-flex flex-column mt-3'>
        <a href="{{ route('adm') }}">
            <div class='padding-2 borderRadius-10 neomorphic-card margin-1 animated-bounce-buttom'>
                <i class="fa fa-bullseye neomorphic-text-black padding-1p-right"></i>
                <span class='neomorphic-text-black'>METAS</span>
            </div>
        </a>
        <a href="{{ route('at.manual',0) }}">
            <div class='padding-2 borderRadius-10 neomorphic-card margin-1 animated-bounce-buttom'>
                <i class="fa fa-exchange-alt neomorphic-text-black padding-1p-right"></i>
                <span class='neomorphic-text-black'>ATUALIZAÇÃO</span>
            </div>
        </a>
        <a href="{{ route('adm.equipe.adicionar') }}">
            <div class='padding-2 borderRadius-10 neomorphic-card margin-1 animated-bounce-buttom'>
                <i class="fa fa-plus-square text-green padding-1p-right"></i>
                <span class='neomorphic-text-black'>ADICIONAR</span>
            </div>
        </a>
        <a href="{{ route('adm') }}">
            <div class='padding-2 borderRadius-10 neomorphic-card margin-1 animated-bounce-buttom'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black text-black font-weight-500'>VOLTAR</span>
            </div>
        </a>
        <form method='POST'>
            @csrf
            <div class="padding-1 borderRadius-10 neomorphic-card margin-1">
                <input type="text" name="search" id="search" class="neomorphic-input borderRadius-5 padding-1" />
                <button type='submit' class="btn-floating btn-small waves-effect waves-light btn red darken-1 delete text-black">
                    <i class="fas fa-search neomorphic-text-black"></i> PESQUISAR</button>
            </div>
        </form>
    </div>

@endsection

@section('conteudoM')

    @include('administrativo.equipe.tbody_table_equipeM')

@endsection
