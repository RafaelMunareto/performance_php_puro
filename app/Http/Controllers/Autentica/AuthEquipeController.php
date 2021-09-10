<?php

namespace App\Http\Controllers\Autentica;

use App\Http\Controllers\Controller;
use App\Service\Buscador;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthEquipeController extends Controller
{

    public function login()
    {
        return view('autenticacao.login');
    }

    public function login_validate(Request $request, Buscador $buscador)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->back()->withErrors('Usuário e/ou senha incorretos');
        }

        if(Auth::user()->adm == 1){return view('errors.block_func');}

        try{
            $dta = $buscador->buscaMaxMes(Auth::user()->cod_func,Auth::user()->adm_id);
        }catch(QueryException $e){
            return view('errors.assoc');
        }

        return redirect()->route('dashboard', $dta);

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/index');
    }


}
