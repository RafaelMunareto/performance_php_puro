@extends('layouts.basic')
@section('title', 'Registrar')
@section('conteudo')
@section('titulo') REGISTRAR ADM @endsection

<div id='desktop' class='animated fadeIn' >

    <div class='d-flex flex-column justify-content-center container mt-5 mb-5 '>
        <form method='POST' class='d-flex justify-content-center align-center flex-column'>
            @csrf
            <select name='validaAdm' id='validaAdm' onchange='window.location="/registrar/" + this.value'
                class="neomorphic-input margin-05 padding-1 borderRadius-20 col-4 text-gray font-weigth-600" required>
                <option @if($id == 1) {{'selected'}} @endif value="1">PERFIL ADMINISTRADOR</option>
                <option @if($id == 0) {{'selected'}} @endif value="0">PERFIL FUNCIONÁRIO</option>
            </select>
            <input name='cod_func' type='number' class='neomorphic-input margin-05 padding-1 borderRadius-20 col-4 validate' title='Código ou matrícula do funcionário' placeholder='Código Administrador' required>
            <input name='name' class='neomorphic-input margin-05 padding-1 borderRadius-20 col-4' placeholder='Nome' class="validate" minlength=3 required>
            <input name='email' type='email' class='neomorphic-input margin-05 padding-1 borderRadius-20 col-4 validate' placeholder='Email'minlength=3 required>
            <input name='password' id='password' type='password' class='neomorphic-input margin-05 padding-1 borderRadius-20 col-4 validate' placeholder='Senha' required autocomplete="new-password" minlength=6>
            <input name="password_confirmation" id="passwordConfirma"  type='password' class='neomorphic-input margin-05 padding-1 borderRadius-20 col-4 validate' placeholder='Repete a senha'required required autocomplete="new-password">
            <button type='submit' class='neomorphic-buttom margin-1 padding-1 borderRadius-20 text-red col-4 mt-4 buttonTransform animated-bounce-buttom'><i class="fas fa-lock"></i> REGISTRAR </button>
        </form>
        <div class='text-center'>
            <a href="{{ route('password.update') }}" class='neomorphic-text-black margin-1 padding-1 borderRadius-10 col-12 buttonTransform animated-bounce-buttom'><i class="fas fa-eraser"></i> ESQUECEU A SENHA? </a>
        </div>
    </div>

</div>

<div id='mobile'>

    <div class='d-flex flex-column justify-content-center container mt-5 mb-5 '>
        <form method='POST' class='d-flex justify-content-center align-center row'>
            @csrf
            <select name='validaAdm' onchange='window.location="/registrar/" + this.value'
            class="neomorphic-input margin-05 padding-1 borderRadius-10 col-12 text-gray font-weigth-600" required>
                <option @if($id == 1) {{'selected'}} @endif value="1">PERFIL ADMINISTRADOR</option>
                <option @if($id == 0) {{'selected'}} @endif value="0">PERFIL FUNCIONÁRIO</option>
            </select>
            <input name='cod_func' type='number' class='neomorphic-input margin-05 padding-1 borderRadius-10 col-12 validate' title='Somente números' placeholder='Código Administrador' required>
            <input name='name' class='neomorphic-input margin-05 padding-1 borderRadius-10 col-12' placeholder='Nome' class="validate" minlength=3 required>
            <input name='email' type='email' class='neomorphic-input margin-05 padding-1 borderRadius-10 col-12 validate' placeholder='Email'minlength=3 required>
            <input name='password' id='password' type='password' class='neomorphic-input margin-05 padding-1 borderRadius-10 col-12 validate' placeholder='Senha' required autocomplete="new-password" minlength=6>
            <input name="password_confirmation" id="passwordConfirma"  type='password' class='neomorphic-input margin-05 padding-1 borderRadius-10 col-12 validate' placeholder='Repete a senha'required required autocomplete="new-password">
            <button type='submit' class='neomorphic-buttom margin-1 padding-1 borderRadius-10 text-red col-12 mt-4 animated-bounce-buttom'><i class="fas fa-lock"></i> REGISTRAR </button>
        </form>
        <div class='text-center'>
            <a href="{{ route('password.update') }}" class='neomorphic-text-black margin-1 padding-1 borderRadius-10 col-12 animated-bounce-buttom'><i class="fas fa-eraser neomorphic-text-black"></i> ESQUECEU A SENHA? </a>
        </div>
    </div>

</div>

@endsection




