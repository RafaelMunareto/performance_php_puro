@extends('layouts.basic')
@section('title', 'Abertura Adm')
@section('conteudo')

<div id='desktop' class='animated fadeIn' >

    <div class='d-flex justify-content-around margin-1 flex-wrap min-height-70vh animated fadeIn ' id='aberturaIcones'>

        <a href="{{ route('adm') }}" class='d-flex flex-column margin-05 animated-flip-buttom'>
            <span class='neomorphic-text-black text-center size100 mb-1' >AT. MANUAL</span>
            <div class='padding-3 neomorphic-card borderRadius-10 margin-2  margin-2p-top'>
                <i class="fas fa-people-carry fa-4x neomorphic-text-black padding-1"></i>
            </div>
        </a>

        <a href="{{ route('atualizacao_abertura') }}" class='d-flex flex-column margin-05 animated-flip-buttom' id='aberturaIcones'>
            <span class='neomorphic-text-black text-center size100 mb-1'> AT.AUTOMÁTICO</span>
            <div class='padding-3 neomorphic-card borderRadius-10 margin-2  margin-2p-top'>
                <i class="fas fa-database fa-4x neomorphic-text-black padding-1"></i>
            </div>
        </a>

        <a href="{{ route('gestao.abertura', $dta) }}" class='d-flex flex-column margin-05 animated-flip-buttom' id='aberturaIcones'>
            <span class='neomorphic-text-black text-center size100 mb-1' >GESTÃO</span>
            <div class='padding-3 neomorphic-card borderRadius-10 margin-2  margin-2p-top'>
                <i class="fas fa-chart-pie fa-4x neomorphic-text-black padding-1"></i>
            </div>
        </a>

        <a href="{{ route('gestao.visaoTotal', $dta) }}" class='d-flex flex-column margin-05 animated-flip-buttom' id='aberturaIcones'>
            <span class='neomorphic-text-black text-center size100 mb-1' >VISÃO TOTAL</span>
            <div class='padding-3 neomorphic-card borderRadius-10 margin-2  margin-2p-top'>
                <i class="fas fa-project-diagram fa-4x neomorphic-text-black padding-1"></i>
            </div>
        </a>
    </div>

</div>

<div id='mobile'>

    <div class='d-flex justify-content-around flex-wrap  mb-5' >

        <a href="{{ route('adm') }}"  class='d-flex flex-column margin-05 animated flipInX animated-flip-buttom' id='aberturaIcones'>
            <span class='neomorphic-text-gray text-center size120 mb-2' >AT. MANUAL</span>
            <div class='padding-3 neomorphic-card borderRadius-10 margin-1  margin-2p-top'>
                <i class="fas fa-people-carry fa-4x neomorphic-text-gray padding-1"></i>
            </div>
        </a>

        <a href="{{ route('atualizacao_abertura') }}" class='d-flex flex-column margin-05 animated flipInX animated-flip-buttom' id='aberturaIcones'>
            <span class='neomorphic-text-gray text-center size120 mb-2' > AT.AUTOMÁTICO</span>
            <div class='padding-3 neomorphic-card borderRadius-10 margin-1  margin-2p-top'>
                <i class="fas fa-database fa-4x neomorphic-text-gray padding-1"></i>
            </div>
        </a>

        <a href="{{ route('gestao.abertura', $dta) }}" class='d-flex flex-column margin-05 animated flipInX animated-flip-buttom' id='aberturaIcones'>
            <span class='neomorphic-text-gray text-center size120 mb-2' >GESTÃO</span>
            <div class='padding-3 neomorphic-card borderRadius-10 margin-1  margin-2p-top'>
                <i class="fas fa-chart-pie fa-4x neomorphic-text-gray padding-1"></i>
            </div>
        </a>

        <a href="{{ route('gestao.visaoTotal', $dta) }}" class='d-flex flex-column margin-05 animated flipInX animated-flip-buttom' id='aberturaIcones'>
            <span class='neomorphic-text-gray text-center size150 mb-2' >VISÃO TOTAL</span>
            <div class='padding-3 neomorphic-card borderRadius-10 margin-1 margin-2p-top'>
                <i class="fas fa-project-diagram fa-4x neomorphic-text-gray padding-1"></i>
            </div>
        </a>

    </div>

</div>

@endsection
