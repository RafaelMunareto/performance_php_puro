@extends('layouts.basic_sem_efeito')
@section('title', 'Atualizando...')
@section('conteudo')
@section('titulo') ATUALIZANDO ...@endsection

<div id='desktop' class='animated fadeIn' >

    <div class='margin-2 padding-3 borderRadius-20 d-flex justify-content-center'>

        <form method="POST" action='/atualizar' class='d-flex justify-content-center flex-column'>
            @csrf

            <input name='progresso' id='progresso' class='display-none' value={{$progresso}}>
            <input name='verificaBase' id='verificaBase' class='display-none' value='{{$verificaBase}}'>

            <div id='preloaderAtualizar' class='neomorphic-card padding-1 borderRadius-10 w100'>

                <div class='w90 padding-5'>
                    <span id='{{number_format($perc,2)}}' class='color-text-attr text-right size150 text-right padding-2 animated flipInX'>{{number_format($perc,2)}}%</span>
                </div>

                <div id='progress' class="progress soft animated bounceIn">
                    <span id='{{number_format($perc,2)}}' class='color-attr text-white align-middle text-center'></span>
                </div>

            </div>

            <button type='submit' id='buttonAtualizar' class='display-none'>
                <i class="fas fa-sync"></i>
                 ATUALIZAR
             </button>

        </form>

    </div>


</div>

<div id='mobile'>
    <div class='d-flex justify-content-center margin-1 flex-wrap' id='aberturaIcones'>
        <a href="{{ route('adm.abertura') }}" class='d-flex flex-column margin-1 mt-3 mb-1'>
            <div class='padding-1 neomorphic-card borderRadius-20 margin-05 margin-2p-top text-center'>
                <i class="fas fa-lock fa-4x neomorphic-text-gray text-red padding-2 w100"></i>
                <span class='neomorphic-text-black vertical-bottom text-center size80'>NÃO ESTÁ DISPONÍVEL PARA DISPOSITIVOS MÓVEIS</span>
            </div>
            <h2 class='neomorphic-text-gray text-center size100'>Clique no quadro para voltar</h2>
        </a>
    </div>

</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script>

$(document).ready(function (){

    var base = parseInt($('#verificaBase').val());
    var progresso =  parseInt($('#progresso').val());

    if( progresso < base ){
        $("#buttonAtualizar").trigger('click');
    }

});

</script>
