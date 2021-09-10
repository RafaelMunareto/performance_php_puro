@extends('layouts.basic')
@section('title', 'Dashboard')
@section('conteudo')

    <div id='desktop' class='animated fadeIn' >

        <div class='d-flex justify-content-around flex-wrap mt-2 mb-2 vue'>
            <vc-notas cod='{{ $cod_func }}'
                      nome_func='{{ $nome_func }}'
                      dataprop='{{ $data }}'
                      dta='{{ $dta }}'
            ></vc-notas>
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

        <div class='d-flex justify-content-between flex-wrap'>

            <select name='sl' onchange='window.location="/dashboard_adm/visaoTotal" + this.value'
            class="neomorphic-input margin-05 col-12 padding-05 borderRadius-10 text-gray text-center font-weigth-600 text-uppercase">
                @foreach($sl as $linha)
                    <option @if($dta == $linha->mesN) {{'selected'}} @endif value="/{{$linha->mesN}}">{{$buscador->buscaMes($linha->mesN)}}</option>
                @endforeach
            </select>

            <select name='validaAdm' onchange='window.location="/dashboard_adm/visaoTotal/{{$dta}}?cod_func=" + this.value'
                id='funcAt_manual' class="margin-05 col-12 padding-1 borderRadius-10 text-blcack font-weigth-600 text-uppercase size90 animated fadeInRight">
                @foreach($sl_func as $linha)
                    @if($linha->cod_func == $cod_func)
                        <option selected value="{{$linha->cod_func}}">{{$linha->nome}}</option>
                    @else
                        <option  value="{{$linha->cod_func}}">{{$linha->nome}}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class='d-flex justify-content-center flex-wrap mt-2 mb-2'>
            @include('dashboard_adm.visaoTotal.principal.notas')
        </div>

        <div class='d-flex justify-content-end'>
            <a href="/dashboard_adm/visaoTotal/simulador/{{$dta}}?cod_func={{$cod_func}}" title="SIMULADOR">
                <div class="icon-item borderRadius-20 margin-0 padding-1 margin-05 buttonTransform">
                    <i class="fa fa-calculator text-green"></i>
                </div>
            </a>
        </div>
        <div class='neomorphic-conc borderRadius-20 padding-05 mr-2 ml-2 mb-5 text-center d-flex justify-content-center'>
            @include('dashboard_adm.visaoTotal.principal.graficoM')
        </div>

        @include('dashboard_adm.visaoTotal.principal.ranking')
        @include('dashboard_adm.visaoTotal.principal.itemsMobile')

        <div class='neomorphic-conc borderRadius-20 padding-05 mr-2 ml-2 mb-5 text-center d-flex justify-content-center flex-wrap'>
            @include('dashboard_adm.visaoTotal.principal.carousel')
        </div>

    </div>


@endsection
