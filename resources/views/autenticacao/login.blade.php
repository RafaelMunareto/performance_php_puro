@extends('layouts.basic')
@section('title', 'Login')
@section('conteudo')
@section('titulo') LOGIN @endsection

<div id='desktop' class='animated fadeIn' >

    <div class='d-flex flex-column justify-content-center container mt-5 mb-5'>

        <div class='min-height-30vh vue d-flex justify-content-center'>
            <vc-login>@csrf</vc-login>
        </div>
        <div class='d-flex justify-content-center'>
            <a href="{{ route('registrar',0) }}"class='neomorphic-text-black margin-1 padding-1 borderRadius-20 mt-4 buttonTransform animated-bounce-buttom'><i class="fas fa-unlock"></i> REGISTRE-SE </a>
            <a href="{{ route('password.update') }}" class='neomorphic-text-black margin-1 padding-1 borderRadius-20 mt-4 buttonTransform animated-bounce-buttom'><i class="fas fa-eraser"></i> ESQUECEU A SENHA? </a>
        </div>
    </div>

</div>

<div id='mobile'>

    <div class='d-flex flex-column justify-content-center container mt-5 mb-5 '>
        <form method='POST' class='d-flex justify-content-center align-center flex-column'>
            @csrf
            <input name='email' class='neomorphic-input margin-05 padding-1 borderRadius-10 col-12 validate' placeholder='Email' required id="email" type="email">
            <input name='password' class='neomorphic-input margin-05 padding-1 borderRadius-10 col-12 validate' placeholder='Senha' required min="6" type="password">
            <button type='submit' class='neomorphic-buttom margin-1 padding-1 borderRadius-10 text-red col-12 mt-4 animated-bounce-buttom'><i class="fas fa-lock"></i> ACESSAR </button>
            <div class='row'>
                <a href="{{ route('registrar',0) }}"class='neomorphic-text-black margin-1 padding-1 col-12 animated-bounce-buttom'><i class="fas fa-unlock neomorphic-text-black "></i> REGISTRE-SE </a>
                <a href="{{ route('password.update') }}" class='neomorphic-text-black margin-1 padding-1 col-12 animated-bounce-buttom'><i class="fas fa-eraser neomorphic-text-black "></i> ESQUECEU A SENHA? </a>
            </div>
        </form>
    </div>

</div>

@endsection

