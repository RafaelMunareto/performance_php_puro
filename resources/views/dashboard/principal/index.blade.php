@extends('layouts.principal')
@section('title', 'Dashboard')
@section('conteudo')

    <div id='desktop' class='animated fadeIn' >

        <div class='d-flex justify-content-around flex-wrap mt-2 mb-2 vue'>
            <vc-notas cod='{{ $cod_func }}'
                    nome_func='{{ $nome_func }}'
                    dataprop='{{ $data }}'
                    dta='{{ $dta }}'
                    auth='func'>
            </vc-notas>
        </div>

        <div class='neomorphic-conc borderRadius-20 padding-05 mr-2 ml-2 mb-5 text-center d-flex justify-content-center flex-wrap'>
            @include('dashboard_adm.visaoTotal.principal.carousel')
        </div>

    </div>


    <div id='mobile'>

        <div class="btnSupEsquerdo">
            <a href="#top" class="glyphicon glyphicon-chevron-up">
                <button class="neomorphic-buttom padding-1 borderRadius-50 btnPrincipal text-green back-to-top" name="3" >
                    <i class="fa fa-arrow-up"></i>
                </button>
            </a>
        </div>

        <div class='d-flex justify-content-start'>
            <select name='sl' onchange='window.location="/dashboard" + this.value'
            class="neomorphic-input col-12 padding-05 borderRadius-10 text-gray text-center font-weigth-600 text-uppercase">
                @foreach($sl as $linha)
                    <option @if($dta == $linha->mesN) {{'selected'}} @endif value="/{{$linha->mesN}}">{{$buscador->buscaMes($linha->mesN)}}</option>
                @endforeach
            </select>
        </div>

        <div class='d-flex justify-content-center flex-wrap mt-2 mb-2'>
            @include('dashboard.principal.notas')
        </div>

        <div class='neomorphic-conc borderRadius-20 padding-05 mr-2 ml-2 mb-5 text-center d-flex justify-content-center'>
            @include('dashboard.principal.graficoM')
        </div>

        @include('dashboard.principal.ranking')
        @include('dashboard.principal.itemsMobile')

        <div class='neomorphic-conc borderRadius-20 padding-05 mr-2 ml-2 mb-5 text-center d-flex justify-content-center flex-wrap'>
            @include('dashboard.principal.carousel')
        </div>

    </div>


@endsection

