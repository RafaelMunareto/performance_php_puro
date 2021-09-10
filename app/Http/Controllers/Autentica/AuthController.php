<?php

namespace App\Http\Controllers\Autentica;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestRegistrar;
use App\Service\Buscador;
use App\Service\CadastroCreate;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Exceptions\UrlGenerationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthController extends Controller
{

    public function registrar(int $id)
    {
        if($id == 1){
            return view('autenticacao.registrarAdm', compact('id'));
        }
        if($id == 0){
            return view('autenticacao.registrar', compact('id'));
        }
    }

    public function login_adm()
    {
        return view('autenticacao.loginAdm');
    }

    protected function store(RequestRegistrar $request, Buscador $buscador, CadastroCreate $cadastroCreate)
    {

        if($request->validaAdm == 1){

            $cadastroCreate->createUser($request);
            return redirect()->route('adm');

        }
        if($request->validaAdm == 0){

            if(!$dta = $buscador->buscaMaxMes($request->cod_func, $request->adm_id)){
                return view('errors.assoc_adm');
            }

            $cadastroCreate->createUserEquipe($request);
            return redirect()->route('dashboard', $dta);
        }

    }

    public function login_validate(Request $request, Buscador $buscador)
    {
        $check = DB::table('users')->where('adm', "=", 1)->where('email', $request->email)->get();

        if(isset($check[0])){
            if (!Auth::attempt($request->only(['email', 'password']))) {
                // return redirect()
                //     ->back()
                //     ->withErrors('Usuário e/ou senha incorretos');
            }

            return redirect()->route('adm.abertura');
        }else{
            return redirect()->route('login_adm')
            ->with('error','Você não possui cadastro de administrador.');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/index');
    }




}
