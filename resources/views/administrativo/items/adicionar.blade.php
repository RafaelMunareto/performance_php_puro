@extends('layouts.basic')
@section('title', 'Adicionar')
@section('conteudo')
@section('titulo') ADICIONAR ITEMS {{Auth::user()->name}}  @endsection

    <div id='desktop' class='animated fadeIn' >
        <div class='d-flex flex-column justify-content-center container mt-5 mb-5 container animated fadeIn'>
            <div class='d-flex justify-content-left container mb-3'>
                <a href="{{ route('adm') }}">
                    <div class='padding-05 borderRadius-10 neomorphic-card buttonTransform animated-bounce-buttom'>
                        <i class="fa fa-arrow-circle-left text-blue"></i>
                        <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
                    </div>
                </a>
            </div>

            <form method='POST' action='/adicionar' class='row d-flex justify-content-center align-center container'>
                @csrf
                <input name='cod_item1' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-1 mt-2 text-center' id='cod_item' placeholder='Cod Item'>
                <input name='nome_item1' class='text-uppercase neomorphic-input margin-05 padding-05 borderRadius-10 col-4 mt-2' id='nome_item' placeholder='Nome Item'>
                <input name='meta1' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-2 mt-2 money' id='meta' placeholder='Meta'>
                <input name='peso1' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-1 mt-2 money text-center' id='peso' placeholder='Peso'>
                <select name='categoria1' class="neomorphic-input margin-05 padding-05 borderRadius-10 col-3 mt-2">
                    <option selected value="">CATEGORIA</option>
                    <option value="SPRINT">SPRINT</option>
                    <option value="PRIORITARIO">PRIORITARIO</option>
                    <option value="PRIORITARIO">DIRECIONADOR</option>
                </select>

                <input name='cod_item2' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-1 mt-2 text-center' id='cod_item' placeholder='Cod Item'>
                <input name='nome_item2' class='text-uppercase neomorphic-input margin-05 padding-05 borderRadius-10 col-4 mt-2' id='nome_item' placeholder='Nome Item'>
                <input name='meta2' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-2 mt-2 money' id='meta' placeholder='Meta'>
                <input name='peso2' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-1 mt-2 money text-center' id='peso' placeholder='Peso'>
                <select name='categoria2' class="neomorphic-input margin-05 padding-05 borderRadius-10 col-3 mt-2">
                    <option selected value="">CATEGORIA</option>
                    <option value="SPRINT">SPRINT</option>
                    <option value="PRIORITARIO">PRIORITARIO</option>
                    <option value="PRIORITARIO">DIRECIONADOR</option>
                </select>

                <input name='cod_item3' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-1 mt-2 text-center' id='cod_item' placeholder='Cod Item'>
                <input name='nome_item3' class='text-uppercase neomorphic-input margin-05 padding-05 borderRadius-10 col-4 mt-2' id='nome_item' placeholder='Nome Item'>
                <input name='meta3' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-2 mt-2 money' id='meta' placeholder='Meta'>
                <input name='peso3' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-1 mt-2 money text-center' id='peso' placeholder='Peso'>
                <select name='categoria3' class="neomorphic-input margin-05 padding-05 borderRadius-10 col-3 mt-2">
                    <option selected value="">CATEGORIA</option>
                    <option value="SPRINT">SPRINT</option>
                    <option value="PRIORITARIO">PRIORITARIO</option>
                    <option value="PRIORITARIO">DIRECIONADOR</option>
                </select>

                <input name='cod_item4' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-1 mt-2 text-center' id='cod_item' placeholder='Cod Item'>
                <input name='nome_item4' class='text-uppercase neomorphic-input margin-05 padding-05 borderRadius-10 col-4 mt-2' id='nome_item' placeholder='Nome Item'>
                <input name='meta4' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-2 mt-2 money' id='meta' placeholder='Meta'>
                <input name='peso4' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-1 mt-2 money text-center' id='peso' placeholder='Peso'>
                <select name='categoria4' class="neomorphic-input margin-05 padding-05 borderRadius-10 col-3 mt-2">
                    <option selected value="">CATEGORIA</option>
                    <option value="SPRINT">SPRINT</option>
                    <option value="PRIORITARIO">PRIORITARIO</option>
                    <option value="PRIORITARIO">DIRECIONADOR</option>
                </select>

                <input name='cod_item5' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-1 mt-2 text-center' id='cod_item' placeholder='Cod Item'>
                <input name='nome_item5' class='text-uppercase neomorphic-input margin-05 padding-05 borderRadius-10 col-4 mt-2' id='nome_item' placeholder='Nome Item'>
                <input name='meta5' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-2 mt-2 money' id='meta' placeholder='Meta'>
                <input name='peso5' class='neomorphic-input margin-05 padding-05 borderRadius-10 col-1 mt-2 money text-center' id='peso' placeholder='Peso'>
                <select name='categoria5' class="neomorphic-input margin-05 padding-05 borderRadius-10 col-3 mt-2">
                    <option selected value="">CATEGORIA</option>
                    <option value="SPRINT">SPRINT</option>
                    <option value="PRIORITARIO">PRIORITARIO</option>
                    <option value="PRIORITARIO">DIRECIONADOR</option>
                </select>
                <button type='submit' class='neomorphic-buttom padding-05 borderRadius-10 mt-3 col-2 text-blue buttonTransform size80'><i class="fas fa-save text-blue"></i> SALVAR </button>
            </form>
        </div>
    </div>

    <div id='mobile'>
        <div class='d-flex flex-column mt-3'>

            <a href="{{ route('adm') }}">
                <div class='padding-2 borderRadius-10 neomorphic-card margin-1 mb-4'>
                    <i class="fa fa-arrow-circle-left text-blue"></i>
                    <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
                </div>
            </a>


            <form method='POST' class='margin-1'>
                @csrf
                <input name='cod_item1' class='neomorphic-input padding-05 borderRadius-10 col-12 mt-3' id='cod_item' placeholder='Cod Item'>
                <input name='nome_item1' class='text-uppercase neomorphic-input padding-05 borderRadius-10 col-12 mt-3' id='nome_item' placeholder='Nome Item'>
                <input name='meta1' class='neomorphic-input padding-05 borderRadius-10 col-12 mt-2 money mt-3' id='meta' placeholder='Meta'>
                <input name='meta1' class='neomorphic-input padding-05 borderRadius-10 col-12 mt-2 money mt-3' id='meta' placeholder='Meta'>
                <select name='categoria1' class="neomorphic-input padding-05 borderRadius-10 col-12 mt-2 mt-3">
                    <option selected value="">CATEGORIA</option>
                    <option value="SPRINT">SPRINT</option>
                    <option value="PRIORITARIO">PRIORITARIO</option>
                    <option value="PRIORITARIO">DIRECIONADOR</option>
                </select>
                <button type='submit' class='neomorphic-buttom padding-2 borderRadius-10 col-12 text-blue mt-3 mb-5'><i class="fas fa-save text-blue"></i> SALVAR </button>
            </form>
        </div>
    </div>


@endsection
