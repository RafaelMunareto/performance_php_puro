@extends('layouts.basic')
@section('title', 'Contato')
@section('conteudo')
@section('titulo') CONTATO @endsection

    <div id='desktop' class='animated fadeIn' >

        <div class='d-flex flex-column justify-content-center container mt-5 mb-5 '>
            <form method='POST' class='d-flex justify-content-center align-center flex-column'>
                @csrf
                <input name='cod_func' type='number' class='neomorphic-input margin-05 padding-1 borderRadius-20 col-4 validate' title='Somente números' placeholder='Cod Funcionário' required>
                <input name='nome' class='neomorphic-input margin-05 padding-1 borderRadius-20 col-4' placeholder='Nome' class="validate" minlength=3 required>
                <input name='email' type='email' class='neomorphic-input margin-05 padding-1 borderRadius-20 col-4 validate' placeholder='Email'minlength=3 required>
                <textarea name="mensagem"  type='text' class='neomorphic-input margin-05 padding-1 borderRadius-20 col-4 validate' placeholder='Mensagem'required></textarea>
                <button type='submit' class='neomorphic-buttom margin-1 padding-1 borderRadius-20 text-red col-4 mt-4 buttonTransform animated-bounce-buttom'><i class="fas fa-paper-plane"></i> ENVIAR </button>
            </form>
        </div>

    </div>

    <div id='mobile'>

        <div class='d-flex flex-column justify-content-center container mt-5 mb-5 '>
            <form method='POST' class='d-flex justify-content-center align-center flex-column'>
                @csrf
                <input name='cod_func' type='number' class='neomorphic-input margin-05 padding-1 borderRadius-10 col-12 validate' title='Somente números' placeholder='Cod Funcionário' required>
                <input name='nome' class='neomorphic-input margin-05 padding-1 borderRadius-10 col-12' placeholder='Nome' class="validate" minlength=3 required>
                <input name='email' type='email' class='neomorphic-input margin-05 padding-1 borderRadius-10 col-12 validate' placeholder='Email'minlength=3 required>
                <textarea name="mensagem"  type='text' class='neomorphic-input margin-05 padding-1 borderRadius-10 col-12 validate' placeholder='Mensagem'required></textarea>
                <button type='submit' class='neomorphic-buttom margin-1 padding-1 borderRadius-10 text-red col-12 mt-4 animated-bounce-buttom'><i class="fas fa-paper-plane"></i> ENVIAR </button>
            </form>
        </div>

    </div>

@endsection


