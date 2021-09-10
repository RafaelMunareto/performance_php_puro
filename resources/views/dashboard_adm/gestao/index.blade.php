@extends('layouts.basic')
@section('title', 'Abertura')
@section('conteudo')

<div id='desktop' class='animated fadeIn'  >

    <div class='d-flex justify-content-around margin-1 flex-wrap min-height-70vh' id='aberturaIcones'>


            <a href="{{ route('gestao.prod', $dta) }}" class='d-flex flex-column margin-1 mt-3 mb-3 animated-flip-buttom' id='animated-flip-buttom'>
                <span class='neomorphic-text-black text-center size100 mb-1'>ANÁLISE DE PRODUÇÃO</span>
                <div class='padding-3 neomorphic-card borderRadius-10 margin-2  margin-2p-top'>
                    <i class="fas fa-industry fa-4x neomorphic-text-black padding-1"></i>
                </div>
            </a>

            <a href="{{ route('gestao.ranking', $dta) }}" class='d-flex flex-column margin-1 mt-3 mb-3 animated-flip-buttom' id='aberturaIcones'>
                <span class='neomorphic-text-black text-center size100 mb-1'>ANÁLISE DO RANKING</span>
                <div class='padding-3 neomorphic-card borderRadius-10 margin-2  margin-2p-top'>
                    <i class="fas fa-medal fa-4x neomorphic-text-black padding-1"></i>
                </div>
            </a>

            <a href='/dashboard_adm/index/{{$dta}}/items?dta={{$dta}}' class='d-flex flex-column margin-1 mt-3 mb-3 animated-flip-buttom' id='aberturaIcones'>
                <span class='neomorphic-text-black text-center size100 mb-1'>ANÁLISE DE ITENS</span>
                <div class='padding-3 neomorphic-card borderRadius-10 margin-2  margin-2p-top'>
                    <i class="fas fa-chart-area fa-4x neomorphic-text-black padding-1"></i>
                </div>
            </a>

            {{-- <a href='/dashboard_adm/mosaico/{{$dta}}' class='d-flex flex-column margin-1 mt-3 mb-3 animated-flip-buttom' id='aberturaIcones'>
                <span class='neomorphic-text-black text-center size100 mb-1'>MOSAICO</span>
                <div class='padding-3 neomorphic-card borderRadius-10 margin-2  margin-2p-top'>
                    <i class="fas fa-th fa-4x neomorphic-text-black padding-1"></i>
                </div>
            </a> --}}

    </div>
</div>

<div id='mobile'>


    <div class='d-flex justify-content-center margin-1 flex-wrap' id='aberturaIcones'>

            <a href="{{ route('gestao.prod', $dta) }}" class='d-flex flex-column margin-1 mt-3 mb-3 animated-flip-buttom animated flipInX'>
                <span class='neomorphic-text-black text-center size120 mb-2'>ANÁLISE DE PRODUÇÃO</span>
                <div class='padding-2 neomorphic-card borderRadius-10 margin-2  margin-2p-top'>
                    <i class="fas fa-industry fa-4x neomorphic-text-gray padding-1"></i>
                </div>
            </a>

            <a href="{{ route('gestao.ranking', $dta) }}" class='d-flex flex-column margin-1 mt-3 mb-3 animated-flip-buttom animated flipInX' id='aberturaIcones'>
                <span class='neomorphic-text-black text-center size120 mb-2'>ANÁLISE DO RANKING</span>
                <div class='padding-2 neomorphic-card borderRadius-10 margin-2  margin-2p-top'>
                    <i class="fas fa-medal fa-4x neomorphic-text-gray padding-1"></i>
                </div>
            </a>

            <a href='/dashboard_adm/index/{{$dta}}/items?dta={{$dta}}' class='d-flex flex-column margin-1 mt-3 mb-3 animated-flip-buttom animated flipInX' id='aberturaIcones'>
                <span class='neomorphic-text-black text-center size120 mb-2'>ANÁLISE DO ITENS</span>
                <div class='padding-2 neomorphic-card borderRadius-10 margin-2  margin-2p-top'>
                    <i class="fas fa-chart-area fa-4x neomorphic-text-gray padding-1"></i>
                </div>
            </a>

    </div>


</div>

@endsection
