<?php

namespace App\Http\Controllers\Dashboard;

use App\Adm;
use App\Http\Controllers\Controller;
use App\Notas;
use App\Service\Buscador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimuladorController extends Controller
{

    public function __construct()
    {
        $this->middleware('equipe');
    }

    public function index(Request $request, Buscador $buscador, int $dta)
    {
        //data última atualizacao
        $data = $buscador->buscaMaxUpdate($dta);
        $cod_func = $request->input('cod_func');

        $adm_id = Auth::user()->adm_id;
        $notas = Notas::distinct()->where('cod_func', $cod_func)->where('adm_id', $adm_id)->where('data', $data)->get();

        foreach($notas as $linha){
            $cod_func = $linha->cod_func;
            $nome_func = $linha->nome_func;
        }
        $sprintCount = Adm::distinct()->where('cod_func', $cod_func)->where('data', $data)->where('adm_id', $adm_id)->distinct()->where('categoria', 'SPRINT')->count();
        $prioritarioCount = Adm::distinct()->where('cod_func', $cod_func)->where('data', $data)->where('adm_id', $adm_id)->distinct()->where('categoria', 'PRIORITARIO')->count();
        $direcionadorCount = Adm::distinct()->where('cod_func', $cod_func)->where('data', $data)->where('adm_id', $adm_id)->distinct()->where('categoria', 'DIRECIONADOR')->count();
        if($sprintCount>0){$countSprint = 1;}
        if($prioritarioCount>0){$countPrioritario = 1;}
        if($direcionadorCount>0){$countDirecionador = 1;}
        $count = $countSprint+$countPrioritario+$countDirecionador;


        //items
        $sprint = Adm::distinct()->where('cod_func', $cod_func)->where('data', $data)->where('adm_id', $adm_id)->distinct()->where('categoria', 'SPRINT')->get();
        $prioritario = Adm::distinct()->where('cod_func', $cod_func)->where('data', $data)->where('adm_id', $adm_id)->distinct()->where('categoria', 'PRIORITARIO')->get();
        $direcionador = Adm::distinct()->where('cod_func', $cod_func)->where('data', $data)->where('adm_id', $adm_id)->distinct()->where('categoria', 'DIRECIONADOR')->get();
        $total = Adm::distinct()->where('cod_func', $cod_func)->where('data', $data)->where('adm_id', $adm_id)->distinct()->get();

        return view('dashboard.simulador.index', compact('notas',
                                                         'count',
                                                         'cod_func',
                                                         'sprint',
                                                         'prioritario',
                                                         'direcionador',
                                                         'sprintCount',
                                                         'prioritarioCount',
                                                         'direcionadorCount',
                                                         'total',
                                                         'dta',
                                                         'buscador',
                                                         'cod_func',
                                                         'nome_func'));
    }
}
