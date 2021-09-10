@extends('layouts.basic')
@section('title', 'Adicionar')
@section('conteudo')
@section('titulo') ADICIONAR EQUIPE @endsection

<div id='desktop' class='animated fadeIn' >

    <div class='d-flex flex-column justify-content-center container mt-5 mb-5 container animated fadeIn'>

        <div class='d-flex justify-content-left container mb-3'>
            <a href="{{ route('adm.equipe') }}">
                <div class='padding-05 borderRadius-10 neomorphic-card buttonTransform animated-bounce-buttom'>
                    <i class="fa fa-arrow-circle-left text-blue"></i>
                    <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
                </div>
            </a>
        </div>

        <form method='POST' class='row container d-flex justify-content-center'>
            @csrf
            <input name='cod_func1' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-2 text-center' id='cod_func' placeholder='Cod Func'>
            <input name='nome_func1' class='text-uppercase neomorphic-input margin-05 padding-05 borderRadius-10 col-8' id='nome_func' placeholder='Nome Func'>

            <input name='cod_func2' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-2 text-center' id='cod_func' placeholder='Cod Func'>
            <input name='nome_func2' class='text-uppercase neomorphic-input margin-05 padding-05 borderRadius-10 col-8' id='nome_func' placeholder='Nome Func'>

            <input name='cod_func3' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-2 text-center' id='cod_func' placeholder='Cod Func'>
            <input name='nome_func3' class='text-uppercase neomorphic-input margin-05 padding-05 borderRadius-10 col-8' id='nome_func' placeholder='Nome Func'>

            <input name='cod_func4' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-2 text-center' id='cod_func' placeholder='Cod Func'>
            <input name='nome_func4' class='text-uppercase neomorphic-input margin-05 padding-05 borderRadius-10 col-8' id='nome_func' placeholder='Nome Func'>

            <input name='cod_func5' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-2 text-center' id='cod_func' placeholder='Cod Func'>
            <input name='nome_func5' class='text-uppercase neomorphic-input margin-05 padding-05 borderRadius-10 col-8' id='nome_func' placeholder='Nome Func'>

            <button type='submit' class='neomorphic-buttom padding-05 borderRadius-10 col-2 mt-3 text-blue buttonTransform size80'><i class="fas fa-save text-blue"></i> SALVAR </button>
        </form>

    </div>

</div>

<div id='mobile'>

    <div class='d-flex flex-column mt-3'>
        <a href="{{ route('adm.equipe') }}">
            <div class='padding-2 borderRadius-10 neomorphic-card  mb-4 animated-bounce-buttom'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
            </div>
        </a>
        <form method='POST'>
            @csrf
            <form method='POST' action='/adicionar_equipe' class=''>
                @csrf
                <input name='cod_func' class='neomorphic-input padding-05 borderRadius-10 mt-3 col-12 text-center' id='cod_func' placeholder='Cod Func'>
                <input name='nome_func' class='text-uppercase neomorphic-input padding-05 mt-3 borderRadius-10 col-12' id='nome_func' placeholder='Nome Func'>
                <button type='submit' class='neomorphic-buttom padding-05 borderRadius-10 mt-3 mb-5 text-gray col-12'><i class="fas fa-save"></i> Salvar </button>
            </form>
            <button type='submit' class='neomorphic-buttom padding-2 borderRadius-10 col-12 mt-3 text-blue mb-5'><i class="fas fa-save text-blue"></i> SALVAR </button>
        </form>
    </div>

</div>


@endsection
