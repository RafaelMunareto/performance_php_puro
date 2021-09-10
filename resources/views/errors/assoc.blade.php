@extends('layouts.basic')
@section('title', 'META NÃO ASSOCIADA')
@section('conteudo')

<div class='d-flex justify-content-center margin-9 flex-wrap  animated fadeIn' id='aberturaIcones'>
    <a href="{{ route('abertura') }}"class='d-flex flex-column margin-1 mt-3 mb-1'>
        <div class='padding-5 neomorphic-card borderRadius-20 margin-3 margin-2p-top text-center'>
            <i class="fas fa-exclamation-triangle fa-4x text-orange padding-1"></i>
            <span class='neomorphic-text-black vertical-bottom text-center size150'>META NÃO ASSOCIADA</span>
        </div>
        <h2 class='neomorphic-text-gray text-center size150'>Você não possui meta associada!</h2>
    </a>
</div>
@endsection
