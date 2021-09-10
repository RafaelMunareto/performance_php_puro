
@extends('layouts.basic')
@section('title', 'MOSAICO')
@section('titulo') ANÁLISE MOSAICO - {{Auth::user()->name}} @endsection


@section('navgation')

    <div class='d-flex'>
        <a href="{{ route('gestao.abertura', $dta) }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
            </div>
        </a>
    </div>

@endsection

@section('conteudo')

    <div id='desktop'>
        <div class='d-flex flex-column justify-content-center container-fluid mb-3'>
            <div class='min-height-60vh vue'>
                <vc-gestao_mosaico :datas='{{ $data }}'></vc-gestao_mosaico>
            </div>
        </div>
    </div>


@endsection
