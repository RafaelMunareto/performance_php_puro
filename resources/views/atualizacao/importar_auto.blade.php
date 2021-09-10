@extends('layouts.basic_sem_efeito')
@section('title', 'Importar dados')
@section('conteudo')
@section('titulo') IMPORTAR DADOS EXCEL/TXT/CSV - {{Auth::user()->cod_func}} @endsection


@section('navgation')

    <div class='d-flex'>

        <a href="{{ route('atualizacao_abertura') }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
            </div>
        </a>

@endsection

@section('conteudo')
<div id='desktop' class='animated fadeIn' >

    <div class='neomorphic-conc margin-2 padding-3 borderRadius-20 d-flex justify-content-center'>

        <form method="POST" enctype="multipart/form-data" class='d-flex justify-content-center flex-column'>
            @csrf
			<h4 class='neomorphic-text-gray text-center margin-1 mb-3'><i class="far fa-file-alt text-green "></i> ARQUIVO</h4>
            <div class="form-group ml-1" >
                <label for="fupload" class="control-label label-bordered neomorphic-card text-gray size90 borderRadius-10">Clique aqui para escolher um arquivo</label>
                <input type="file" id="fupload" name="file" class="fupload form-control" />
            </div>
            <div id='preloaderTxt' class='neomorphic-card padding-05 borderRadius-10 w100 display-none animated zoomIn'><img src='{{ asset('img/preloader.gif')}}'></div>
            <button type='submit' id='buttonTxt' class='neomorphic-buttom margin-1 padding-1 borderRadius-10 text-green mt-4 buttonTransform animated-bounce-buttom'>
                <i class="fas fa-file-import"></i> IMPORTAR </button>
        </form>

    </div>

    <div class='neomorphic-conc margin-2 padding-3 borderRadius-20 d-flex justify-content-center flex-column flex-wrap'>
        <h2 class='neomorphic-text-gray text-center margin-1 mb-3'><i class="fas fa-question text-green"></i> AJUDA</h2>
        <h6 class='neomorphic-text-black text-center margin-1 mb-3 ml-4 mr-4 size90'>
            O arquivo não deve conter na sua primeira linha as colunas descritas, os dados devem ser <b>separados por ponto e vírgula, ou vírgula, ou salvos no formato CSV separado por vígula.</b>
            A planilha deve ter as colunas abaixo, passe o mouse para maiores explicações.
        </h6>
        <div class='d-flex justify-content-center size80 mt-4 flex-wrap'>

            <span class='neomorphic-conc padding-1 borderRadius-10 margin-05 size90'
                title='A coluna COD FUNC deve conter a matrícula do funcionário, é integer.'>CÓDIGO FUNCIONÁRIO</span>
            <span class='neomorphic-conc padding-1 borderRadius-10 margin-05 size90'
                title='A coluna NOME FUNC deve conter o nome do funcionário, é string.'>NOME FUNCIONÁRIO</span>
            <span class='neomorphic-conc padding-1 borderRadius-10 margin-05'
                title='A coluna COD ITEM deve conter o código do item, é integer.'>CÓDIGO ITEM</span>
            <span class='neomorphic-conc padding-1 borderRadius-10 margin-05 size90'
                title='A coluna NOME ITEM deve conter o nome do item, é string.'>NOME ITEM</span>
            <span class='neomorphic-conc padding-1 borderRadius-10 margin-05 size90'
                title='A coluna CATEGORIA deve conter a categoria do item (PRIORITARIO, DIRECIONADOR OU SPRINT), é string.'>CATEGORIA</span>
            <span class='neomorphic-conc padding-1 borderRadius-10 margin-05 size90'
                title='A coluna OBJ deve conter o objetivo do item(meta), é float.'>OBJETIVO</span>
            <span class='neomorphic-conc padding-1 borderRadius-10 margin-05 size90'
                title='A coluna RLZ deve conter o realizado do item(meta), é float.'>REALIZADO</span>
            <span class='neomorphic-conc padding-1 borderRadius-10 margin-05 size90'
                title='A coluna PESO deve conter o peso do item, é float.'>PESO</span>
            <span class='neomorphic-conc padding-1 borderRadius-10 margin-05 size90'
                title='A coluna COD ADM deve conter a matrícula ou código do administrador, é integer.'>CÓDIGO ADM</span>
            <span class='neomorphic-conc padding-1 borderRadius-10 margin-05 size90'
                title='A coluna DATA deve estar no formato DD/MM/AA, é string. Caso não seja inserido será usada a data do dia.'>DATA</span>
            <span class='neomorphic-conc padding-1 borderRadius-10 margin-05 size90'
                title='Caso queira utilizar o Percentual esperado, caso não inclua essa coluna o sistema irá calcular o percentual normal'>PERC ESP</span>
        </div>

        <h6 class='neomorphic-text-black text-center margin-1 mb-3 ml-4 mr-4 mt-5'>
            Para excluir algum dia e proceder como uma nova atualizaçao <a href="{{ route('at.manual',0) }}"> clique aqui </a>
            e retorne para para atualização automática.
        </h6>

    </div>

    <div class='neomorphic-conc margin-2 padding-3 borderRadius-20 d-flex justify-content-center flex-column flex-wrap'>
        <h2 class='neomorphic-text-gray text-center margin-1 mb-3'><i class="fas fa-info-circle text-green"></i>  EXEMPLO </h2>
        <h6 class='neomorphic-text-black text-center margin-1 mb-3 ml-4 mr-4'>
            São aceitos arquivos no formato XLS, XLSX, XML, TXT e CSV que deve ser salvo no formato separado por vírgulas.
        </h6>
        <div class='padding-1 margin-1 d-flex justify-content-center'>
            <img class='borderRadius-20 neomorphic-card padding-1' src='{{ asset('img/exemploTxt.png')}}'>
        </div>
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
