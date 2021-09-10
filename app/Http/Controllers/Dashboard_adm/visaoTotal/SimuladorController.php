<?php

namespace App\Http\Controllers\Dashboard_adm\visaoTotal;

use App\Adm;
use App\Func;
use App\Http\Controllers\Controller;
use App\Notas;
use App\Service\Buscador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SimuladorController extends Controller
{

    public function __construct()
    {
        $this->middleware('equipe');
    }

    public function index(Request $request, Buscador $buscador, int $dta)
    {
        //data última atualizacao
        $data = $buscador->buscaMaxUpdateAdm($dta);
        $cod_func = $request->input('cod_func');

        $func = Func::distinct()->where('cod_func', $cod_func)->take(1)->get();

        $adm_id = Auth::user()->cod_func;
        $notas = Notas::distinct()->where('cod_func', $cod_func)->where('adm_id', $adm_id)->where('data', $data)->get();

        //items
        $sprint = Adm::distinct()->where('cod_func', $cod_func)->where('data', $data)->where('adm_id', $adm_id)->distinct()->where('categoria', 'SPRINT')->get();
        $sprintCount = Adm::distinct()->where('cod_func', $cod_func)->where('data', $data)->where('adm_id', $adm_id)->distinct()->where('categoria', 'SPRINT')->count();

        $prioritario = Adm::distinct()->where('cod_func', $cod_func)->where('data', $data)->where('adm_id', $adm_id)->distinct()->where('categoria', 'PRIORITARIO')->get();
        $prioritarioCount = Adm::distinct()->where('cod_func', $cod_func)->where('data', $data)->where('adm_id', $adm_id)->distinct()->where('categoria', 'PRIORITARIO')->count();

        $direcionador = Adm::distinct()->where('cod_func', $cod_func)->where('data', $data)->where('adm_id', $adm_id)->distinct()->where('categoria', 'DIRECIONADOR')->get();
        $direcionadorCount = Adm::distinct()->where('cod_func', $cod_func)->where('data', $data)->where('adm_id', $adm_id)->distinct()->where('categoria', 'DIRECIONADOR')->count();

        $countSprint = 0;
        $countPrioritario = 0;
        $countDirecionador =0;
        if($sprintCount>0){$countSprint = 1;}
        if($prioritarioCount>0){$countPrioritario = 1;}
        if($direcionadorCount>0){$countDirecionador = 1;}
        $count = $countSprint+$countPrioritario+$countDirecionador;


        $total = Adm::distinct()->where('cod_func', $cod_func)->where('data', $data)->where('adm_id', $adm_id)->distinct()->get();

        return view('dashboard_adm.visaoTotal.simulador.index', compact('notas',
                                                                        'sprint',
                                                                        'count',
                                                                        'prioritario',
                                                                        'direcionador',
                                                                        'sprintCount',
                                                                        'prioritarioCount',
                                                                        'direcionadorCount',
                                                                        'total',
                                                                        'dta',
                                                                        'buscador',
                                                                        'func',
                                                                        'cod_func'));
    }
}
