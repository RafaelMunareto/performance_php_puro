@extends('layouts.basic')
@section('title', 'Abertura')
@section('conteudo')

<div id='desktop' class='animated fadeIn'  >

    <div class='d-flex justify-content-center margin-3 flex-wrap' id='aberturaIcones'>


            <a href='{{ route('importarProd') }}' class='d-flex flex-column margin-1 mt-3 mb-3 animated-flip-buttom' id='animated-flip-buttom'>
                <span class='neomorphic-text-black text-center size110 mb-1'>PRODUÇÃO</span>
                <div class='padding-5 neomorphic-card borderRadius-10 margin-5  margin-2p-top'>
                    <i class="fas fa-industry fa-4x neomorphic-text-black padding-1"></i>
                </div>
            </a>

            <a href='{{ route('importar') }}' class='d-flex flex-column margin-1 mt-3 mb-3 animated-flip-buttom' id='aberturaIcones'>
                <span class='neomorphic-text-black text-center size110 mb-1'>RESULTADO</span>
                <div class='padding-5 neomorphic-card borderRadius-10 margin-5  margin-2p-top'>
                    <i class="fas fa-chart-area fa-4x neomorphic-text-black padding-1"></i>
                </div>
            </a>

    </div>


<div id='mobile'>


    <div class='d-flex justify-content-center margin-1 flex-wrap' id='aberturaIcones'>

            <a href='{{ route('importarProd') }}' class='d-flex flex-column margin-1 mt-3 mb-3 animated-flip-buttom animated flipInX'>
                <span class='neomorphic-text-black text-center size120 mb-2'>PRODUÇÃO</span>
                <div class='padding-3 neomorphic-card borderRadius-10 margin-2  margin-2p-top'>
                    <i class="fas fa-industry fa-4x neomorphic-text-gray padding-1"></i>
                </div>
            </a>

            <a href='{{ route('importar') }}' class='d-flex flex-column margin-1 mt-3 mb-3 animated-flip-buttom animated flipInX' id='aberturaIcones'>
                <span class='neomorphic-text-black text-center size120 mb-2'>RESULTADO</span>
                <div class='padding-3 neomorphic-card borderRadius-10 margin-2  margin-2p-top'>
                    <i class="fas fa-chart-area fa-4x neomorphic-text-gray padding-1"></i>
                </div>
            </a>

    </div>


</div>

@endsection
