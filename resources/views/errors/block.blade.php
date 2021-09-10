@extends('layouts.basic')
@section('title', 'Bloqueado')
@section('conteudo')

<div class='d-flex justify-content-center margin-9 flex-wrap  animated fadeIn' id='aberturaIcones'>
    <a href="{{ route('abertura') }}"class='d-flex flex-column margin-1 mt-3 mb-1'>
        <div class='padding-5 neomorphic-card borderRadius-20 margin-3 margin-2p-top text-center'>
            <i class="fas fa-lock fa-4x neomorphic-text-gray text-red padding-1"></i>
            <span class='neomorphic-text-black vertical-bottom text-center size150'>ÁREA DO ADM</span>
        </div>
        <h2 class='neomorphic-text-gray text-center size150'>Área exclusiva do Administrador!</h2>
    </a>
</div>
@endsection
