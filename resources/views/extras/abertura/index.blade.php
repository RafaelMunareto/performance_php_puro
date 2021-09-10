@extends('layouts.basic')
@section('title', 'Abertura')
@section('conteudo')

<div id='desktop' class='animated fadeIn'  >

    <div class='d-flex justify-content-center margin-3 flex-wrap' id='aberturaIcones'>

        @guest
            <a href='/abertura_adm' class='d-flex flex-column margin-1 mt-3 mb-3 animated-flip-buttom' id='animated-flip-buttom'>
                <span class='neomorphic-text-black text-center size110 mb-1'>ADMINISTRATIVO</span>
                <div class='padding-5 neomorphic-card borderRadius-10 margin-5  margin-2p-top'>
                    <i class="fas fa-wrench fa-4x neomorphic-text-black padding-1"></i>
                </div>
            </a>

            <a href='/dashboard/@if(isset($dta)) {{$dta}} @else {{date('m')}} @endif' class='d-flex flex-column margin-1 mt-3 mb-3 animated-flip-buttom' id='aberturaIcones'>
                <span class='neomorphic-text-black text-center size110 mb-1'>FUNCIONÁRIO</span>
                <div class='padding-5 neomorphic-card borderRadius-10 margin-5  margin-2p-top'>
                    <i class="fas fa-user-tie fa-4x neomorphic-text-black padding-1"></i>
                </div>
            </a>
        @endGuest
    </div>

    <div class='d-flex justify-content-center margin-3 flex-wrap' id='aberturaIcones'>
        @auth
            @if(Auth::user()->adm == 1)
                <a href='/abertura_adm' class='d-flex flex-column margin-1 mt-3 mb-3 animated-flip-buttom' id='animated-buttom'>
                    <span class='neomorphic-text-black text-center size150 mb-2'>ADMINISTRATIVO</span>
                    <div class='padding-5 neomorphic-card borderRadius-10 margin-5  margin-2p-top'>
                        <i class="fas fa-wrench fa-4x neomorphic-text-gray padding-1"></i>
                    </div>
                </a>
            @endif
            @if(Auth::user()->adm == 0)
                <a href='/dashboard/@if(isset($dta)) {{$dta}} @else {{date('m')}} @endif' class='d-flex flex-column margin-1 mt-3 mb-3  animated flipInX animated-flip-buttom' id='aberturaIcones'  id='animated-buttom'>
                    <span class='neomorphic-text-black text-center size150 mb-2'>FUNCIONÁRIO</span>
                    <div class='padding-5 neomorphic-card borderRadius-10 margin-5  margin-2p-top'>
                        <i class="fas fa-user-tie fa-4x neomorphic-text-gray padding-1"></i>
                    </div>
                </a>
            @endif
        @endAuth
    </div>

</div>


<div id='mobile'>

    <div class='d-flex justify-content-center margin-1 flex-wrap' id='aberturaIcones'>
        @guest
            <a href='/abertura_adm' class='d-flex flex-column margin-1 mt-3 mb-3 animated-flip-buttom animated flipInX'>
                <span class='neomorphic-text-black text-center size120 mb-2'>ADMINISTRATIVO</span>
                <div class='padding-3 neomorphic-card borderRadius-10 margin-2  margin-2p-top'>
                    <i class="fas fa-wrench fa-4x neomorphic-text-gray padding-1"></i>
                </div>
            </a>

            <a href='/dashboard/0' class='d-flex flex-column margin-1 mt-3 mb-3 animated-flip-buttom animated flipInX' id='aberturaIcones'>
                <span class='neomorphic-text-black text-center size120 mb-2'>FUNCIONÁRIO</span>
                <div class='padding-3 neomorphic-card borderRadius-10 margin-2  margin-2p-top'>
                    <i class="fas fa-user-tie fa-4x neomorphic-text-gray padding-1"></i>
                </div>
            </a>
        @endGuest
    </div>

    <div class='d-flex justify-content-center margin-1 flex-wrap' id='aberturaIcones'>
        @auth
            @if(Auth::user()->adm == 1)
                <a href='/abertura_adm' class='d-flex flex-column margin-1 mt-3 mb-3 animated-flip-buttom animated flipInX'>
                    <span class='neomorphic-text-black text-center size120'>ADMINISTRATIVO</span>
                    <div class='padding-3 neomorphic-card borderRadius-10 margin-2  margin-2p-top'>
                        <i class="fas fa-wrench fa-4x neomorphic-text-gray padding-1"></i>
                    </div>
                </a>
            @endif
            @if(Auth::user()->adm == 0)
                <a href='@if(isset($dta)) {{$dta}} @else {{date('m')}} @endif' class='d-flex flex-column margin-1 mt-3 mb-3  animated flipInX animated-flip-buttom' id='aberturaIcones'>
                    <span class='neomorphic-text-black text-center size120'>FUNCIONÁRIO</span>
                    <div class='padding-3 neomorphic-card borderRadius-10 margin-2  margin-2p-top'>
                        <i class="fas fa-user-tie fa-4x neomorphic-text-gray padding-1"></i>
                    </div>
                </a>
            @endif
        @endAuth
    </div>

</div>

@endsection
