@extends('layouts.basic')
@section('title', 'Vinculados')
@section('titulo') METAS VINCULADAS - {{$nome_func}} @endsection


@section('navgation')

    <div class='d-flex'>

        <a href="{{ route('adm.vinculacao', $id) }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
            </div>
        </a>
        <a href="{{ route('adm.equipe') }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-user-friends neomorphic-text-black"></i>
                <span class='neomorphic-text-black'>EQUIPE</span>
            </div>
        </a>
        <a href="{{ route('at.manual', $cod_func) }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-exchange-alt neomorphic-text-black"></i>
                <span class='neomorphic-text-black'>ATUALIZAÇÃO</span>
            </div>
        </a>

    </div>

@endsection

@section('conteudo')
    <div id='desktop' >
        <div class='d-flex flex-column justify-content-center container mt-4 mb-3 container-fluid'>
            <div class='min-height-70vh vue'><vc-vinculados cod_func='{{ $cod_func }}'></vc-vinculados></div>
        </div>
    </div>
@endsection

@section('navgationM')

    <div class='d-flex flex-column mt-3 margin-1'>

        <a href="{{ route('at.manual', $cod_func) }}">
            <div class='padding-2 borderRadius-10 neomorphic-card margin-1 animated-bounce-buttom'>
                <i class="fa fa-exchange-alt neomorphic-text-black padding-1p-right"></i>
                <span class='neomorphic-text-black'>ATUALIZAÇÃO</span>
            </div>
        </a>
        <a href="{{ route('adm.vinculacao', $id) }}">
            <div class='padding-2 borderRadius-10 neomorphic-card margin-1 animated-bounce-buttom'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
            </div>
        </a>

    </div>

@endsection

@section('conteudoM')

    @include('administrativo.vinculacao.table-resultM')

@endsection
