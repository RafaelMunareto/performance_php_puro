@extends('layouts.basic')
@section('title', 'At_Sucesso!')
@section('conteudo')

<div class='d-flex justify-content-center margin-9 flex-wrap animated flipInX' id='aberturaIcones'>
    <a href="{{ route('adm.abertura') }}" class='d-flex flex-column margin-1 mt-3 mb-1'>
        <div class='padding-5 neomorphic-card borderRadius-20 margin-3 margin-2p-top text-center'>
            <i class="fas fa-check-circle fa-4x text-blue padding-1"></i>
            <span class='neomorphic-text-black vertical-bottom text-center size150'>Base atualizada com sucesso!</span>
        </div>
        <h2 class='neomorphic-text-gray text-center size150'>Clique no quadro para voltar.</h2>
    </a>
</div>
@endsection
