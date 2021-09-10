@extends('layouts.basic')
@section('title', 'Editar')
@section('conteudo')
@section('titulo') EDITAR ITEM {{$cod_item}} @endsection

    <div id='desktop' class='animated fadeIn' >

        <div class='d-flex flex-column justify-content-center container mt-5 mb-5 container animated fadeIn'>
            <div class='d-flex justify-content-left container mb-3'>
                <a href="{{ route('adm') }}">
                    <div class='padding-05 mr-3 borderRadius-10 neomorphic-card buttonTransform animated-bounce-buttom'>
                        <i class="fa fa-arrow-circle-left text-blue"></i>
                        <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
                    </div>
                </a>
            </div>
            <div class='row container-fluid justify-content-center'>
                <div class='neomorphic-table-thead col-1 justify-content-center'> COD_ITEM </div>
                <div class='neomorphic-table-thead col-4 justify-content-center'> NOME ITEM </div>
                <div class='neomorphic-table-thead col-2 justify-content-center'> META </div>
                <div class='neomorphic-table-thead col-1 justify-content-center'> PESO </div>
                <div class='neomorphic-table-thead col-2 justify-content-center'> CATEGORIA </div>
            </div>
            @foreach($cadastro as $linha)
                <form method='POST' action='/editar/{{$linha->id}}' class='d-flex justify-content-center align-center container row'>
                    @csrf
                    <input name='cod_item' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-1 text-center' id='cod_item' placeholder='Cod Item' value='{{$linha->cod_item}}'>
                    <input name='nome_item' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-4 text-uppercase' id='nome_item' placeholder='Nome Item' value='{{$linha->nome_item}}'>
                    <input name='obj' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-2 money' id='meta' placeholder='Meta' value='{{($linha->obj)*100}}'>
                    <input name='peso' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-1 money text-center' id='peso' placeholder='Peso' value='{{($linha->peso)*100}}'>
                        <select name='categoria' class="custom-select neomorphic-input borderRadius-10 ml-2 col-2">
                            <option value="CATEGORIA">CATEGORIA</option>
                            <option @if($linha->categoria === "SPRINT") {{'selected'}} @endif value="SPRINT">SPRINT</option>
                            <option @if($linha->categoria === 'PRIORITARIO') {{'selected'}} @endif value="PRIORITARIO">PRIORITARIO</option>
                            <option @if($linha->categoria === 'DIRECIONADOR') {{'selected'}} @endif value="DIRECIONADOR">DIRECIONADOR</option>
                        </select>
                        <button type='submit' class='neomorphic-buttom padding-05 borderRadius-10 mt-3 col-2 text-blue buttonTransform size80'><i class="fas fa-save text-blue"></i> SALVAR </button>
                    </form>
            @endforeach
        </div>

    </div>

    <div id='mobile'>

        <div class='d-flex flex-column mt-3'>
            <a href="{{ route('adm') }}">
                <div class='padding-2 borderRadius-10 neomorphic-card margin-1 animated-bounce-buttom'>
                    <i class="fa fa-arrow-circle-left text-blue"></i>
                    <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
                </div>
            </a>
            @foreach($cadastro as $linha)
                <form method='POST' action='/editar/{{$linha->id}}' class='col-12'>
                    @csrf
                    <input name='cod_item' class='neomorphic-input mt-3 padding-05 borderRadius-10 col-12' id='cod_item' placeholder='Cod Item' value='{{$linha->cod_item}}'>
                    <input name='nome_item' class='text-uppercase neomorphic-input mt-3 padding-05 borderRadius-10 col-12' id='nome_item' placeholder='Nome Item' value='{{$linha->nome_item}}'>
                    <input name='obj' class='neomorphic-input mt-3 padding-05 borderRadius-10 col-12' id='meta' placeholder='Meta' value='{{$linha->obj}}'>
                    <input name='peso' class='neomorphic-input mt-3 padding-05 borderRadius-10 col-12 money text-center' id='peso' placeholder='Peso' value='{{$linha->peso}}'>
                    <select name='categoria' class="custom-select neomorphic-input borderRadius-10 padding-05 mt-3 mb-3 col-12">
                        <option value="CATEGORIA">CATEGORIA</option>
                            <option @if($linha->categoria === "SPRINT") {{'selected'}} @endif value="SPRINT">SPRINT</option>
                            <option @if($linha->categoria === 'PRIORITARIO') {{'selected'}} @endif value="PRIORITARIO">PRIORITARIO</option>
                            <option @if($linha->categoria === 'DIRECIONADOR') {{'selected'}} @endif value="DIRECIONADOR">DIRECIONADOR</option>
                    </select>
                    <button type='submit' class='neomorphic-buttom padding-2 borderRadius-10 col-12 mt-3 text-blue mb-5'><i class="fas fa-save text-blue"></i> SALVAR </button>
                </form>
            @endforeach
        </div>

    </div>

@endsection
