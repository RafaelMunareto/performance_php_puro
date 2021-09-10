@extends('layouts.basic')
@section('title', 'Editar-equipe')
@section('conteudo')
@section('titulo') EDITAR FUNC. {{$nome_func}} @endsection

<div id='desktop' class='animated fadeIn' >

    <div class='d-flex flex-column justify-content-center container mt-5 mb-5 container-fluid animated fadeIn'>
        <div class='d-flex justify-content-left container mb-3'>
            <a href="{{ route('adm.equipe') }}">
                <div class='padding-05 borderRadius-10 neomorphic-card buttonTransform  animated-bounce-buttom'>
                    <i class="fa fa-arrow-circle-left text-blue"></i>
                    <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
                </div>
            </a>
        </div>
        @foreach($cadastro as $linha)
            <form method='POST' action='/equipe/editar/{{$linha->id}}' class='d-flex justify-content-center align-center container-fluid'>
                @csrf
                <input name='cod_func' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-1 text-center' id='cod_func' placeholder='Cod Func' value='{{$linha->cod_func}}'>
                <input name='nome' class='text-uppercase neomorphic-input margin-05 padding-05 borderRadius-10 col-6 text-uppercase' id='nome_func' placeholder='Nome Func' value='{{$linha->nome}}'>
                <button type='submit' class='neomorphic-buttom padding-05 borderRadius-10 col-2 text-blue buttonTransform size80'><i class="fas fa-save text-blue"></i> SALVAR </button>
            </form>
        @endforeach
    </div>

</div>

<div id='mobile'>

    <div class='d-flex flex-column mt-3'>
        <a href="{{ route('adm.equipe') }}">
            <div class='padding-2 borderRadius-10 neomorphic-card mb-5 animated-bounce-buttom'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
            </div>
        </a>
        @foreach($cadastro as $linha)
            <form method='POST' action='/equipe/editar/{{$linha->id}}'>
                @csrf
                <input name='cod_func' class='neomorphic-input padding-05 borderRadius-10 mt-3' id='cod_func' placeholder='Cod Func' value='{{$linha->cod_func}}'>
                <input name='nome' class='neomorphic-input  padding-05 borderRadius-10 mt-3 text-uppercase' id='nome_func' placeholder='Nome Func' value='{{$linha->nome}}'>
                <button type='submit' class='neomorphic-buttom padding-2 borderRadius-10 mt-3 col-12 mb-5 text-blue'><i class="fas fa-save text-blue"></i> SALVAR </button>
            </form>
        @endforeach
    </div>

</div>

@endsection
