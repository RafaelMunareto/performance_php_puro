
@extends('layouts.principal')
@section('title', 'DISPERSÃO ITENS')
@section('conteudo')
@section('titulo') DISPERSÃO ITENS - {{Auth::user()->adm_id}}  @endsection

@section('navgation')

    <div class='d-flex mr-3'>
        <a href="{{ route('dashboard', $id) }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black'>VOLTAR</span>
            </div>
        </a>
    </div>

@endsection

<div id='desktop' class='animated fadeIn' >

    <div class='d-flex flex-column justify-content-center container-fluid mb-3'>
        <div class='min-height-70vh vue mt-4'>
            <vc-gestao_itens :datas='{{ $datas }}'></vc-gestao_itens>
        </div>
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

    <div class='d-flex flex-column mt-3 margin-1'>
        <a href="{{ route('dashboard', $id) }}">
            <div class='padding-2 borderRadius-10 neomorphic-card margin-1 animated-bounce-buttom'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
            </div>
        </a>
    </div>

    <div class='d-flex justify-content-start'>
        <select name='sl' onchange='window.location="/efetividade/" + this.value + "/items?dta=" + this.value'
        class="neomorphic-input col-12 padding-05 borderRadius-10 text-gray text-center font-weigth-600 text-uppercase">
            @foreach($sl as $linha)
                <option @if($dta == $linha->mesN) {{'selected'}} @endif value="{{$linha->mesN}}">{{$buscador->buscaMes($linha->mesN)}}</option>
            @endforeach
        </select>
    </div>

    <div class='d-flex justify-content-around flex-wrap mt-1'>
        <div class='neomorphic-conc borderRadius-20 mt-2 w100 mb-3 text-center d-flex justify-content-center height-100'>
            @include('dashboard.items.grafico_itemsM')
        </div>

        <div class='d-flex justify-content-around mb-5 mt-3 neomorphic-div flex-wrap height-100 size90'>
            @include('dashboard.items.resultado')
        </div>
    </div>

</div>



@endsection
