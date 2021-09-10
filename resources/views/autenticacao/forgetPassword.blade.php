@extends('layouts.basic')
@section('title', 'Esqueceu a senha')
@section('conteudo')
@section('titulo') RECUPERAR SENHA @endsection

<div id='desktop' class='animated fadeIn' >

    <div class='d-flex flex-column justify-content-center container mt-5 mb-5 '>
        <form  class='d-flex justify-content-center align-center flex-column' method="POST" action="{{ route('password.email') }}">
            @csrf
                <input id="email" type="email" class="neomorphic-input margin-05 padding-1 borderRadius-20 col-4 validate col-8 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                placeholder="email" required autocomplete="email" autofocus>
                <button type='submit' class='neomorphic-buttom margin-1 padding-1 borderRadius-20 text-red col-4 mt-4 buttonTransform animated-bounce-buttom'><i class="fas fa-paper-plane"></i> ENVIAR SENHA </button>
        </form>
    </div>

</div>

<div id='mobile'>

    <div class='d-flex flex-column justify-content-center container mt-5 mb-5 '>
        <form  class='d-flex justify-content-center align-center flex-column' method="POST" action="{{ route('password.email') }}">
            @csrf
                <input id="email" type="email" class="neomorphic-input margin-05 padding-1 borderRadius-10 col-4 validate col-12 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                placeholder="email" required autocomplete="email" autofocus>
                <button type='submit' class='neomorphic-buttom margin-1 padding-1 borderRadius-10 text-red col-12 mt-4 animated-bounce-buttom'><i class="fas fa-paper-plane"></i> ENVIAR SENHA </button>
        </form>
    </div>

</div>

@endsection
