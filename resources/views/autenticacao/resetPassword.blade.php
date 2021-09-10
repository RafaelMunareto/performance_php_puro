@extends('layouts.basic')
@section('title', 'ALTERAR SENHA')
@section('conteudo')
@section('titulo') ALTERAR SENHA @endsection

<div id='desktop' class='animated fadeIn' >

    <div class='d-flex flex-column justify-content-center container mt-5 mb-5 '>
        <form class='d-flex justify-content-center align-center flex-column' method="POST"  action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input id="email" type="email" placeholder='E-mail' class="neomorphic-input margin-05 padding-1 borderRadius-20 col-4 validate
            {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

            <input id="password" placeholder='Senha' type="password" class="neomorphic-input margin-05 padding-1 borderRadius-20 col-4 validate
            {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

            <input id="password-confirm" placeholder='Confirma senha' type="password" class="neomorphic-input margin-05 padding-1 borderRadius-20 col-4 validate"
                name="password_confirmation" required>

            <button type='submit' class='neomorphic-buttom margin-1 padding-1 borderRadius-20 text-red col-4 mt-4 buttonTransform animated-bounce-buttom'><i class="fas fa-lock"></i> REDEFINIR SENHA </button>
        </form>
    </div>

</div>

<div id='mobile'>

    <div class='d-flex flex-column justify-content-center container mt-5 mb-5 '>
        <form class='d-flex justify-content-center align-center flex-column' method="POST"  action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input id="email" type="email" placeholder='E-mail' class="neomorphic-input margin-05 padding-1 borderRadius-10 col-12 validate
            {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

            <input id="password" placeholder='Senha' type="password" class="neomorphic-input margin-05 padding-1 borderRadius-10 col-12 validate
            {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

            <input id="password-confirm" placeholder='Confirma senha' type="password" class="neomorphic-input margin-05 padding-1 borderRadius-10 col-12 validate"
                name="password_confirmation" required>

            <button type='submit' class='neomorphic-buttom margin-1 padding-1 borderRadius-10 text-red col-12 mt-4 animated-bounce-buttom'><i class="fas fa-lock"></i> REDEFINIR SENHA </button>
        </form>
    </div>

</div>
@endsection
