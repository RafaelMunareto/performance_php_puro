<?php

namespace App\Http\Controllers\Extras;

use App\Http\Controllers\Controller;
use App\Service\Buscador;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AberturaController extends Controller
{

    public function index(Buscador $buscador)
    {

        if(Auth::check()){

            if(Auth::user()->adm == 1){

                return redirect()->route('adm.abertura');

            }else if(Auth::user()->adm == 0){

                $dta = $buscador->buscaMaxMes(Auth::user()->cod_func,Auth::user()->adm_id);


                return redirect()->route('dashboard', $dta);
            }

        }else{

            $dta = date('m');
            return view('extras.abertura.index', compact('dta'));
        }



    }
}
