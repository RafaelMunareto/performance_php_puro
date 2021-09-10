<?php

namespace App\Http\Controllers\Dashboard;

use App\Adm;
use App\Http\Controllers\Controller;
use App\Notas;
use App\Ranking;
use App\Service\Buscador;
use App\Service\Calculos;
use App\Service\Formatacao;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('equipe');
    }

    public function index(Request $request, Calculos $calculos, Formatacao $formatacao, Buscador  $buscador, int $dta)
    {

        //variaveis
        $data = $buscador->buscaMaxUpdate($dta);
        $adm_id = Auth::user()->adm_id;
        if($request->input('cod_func')){
            $cod_func = $request->input('cod_func');
        }else{
            $cod_func = Auth::user()->cod_func;
        }

        //items
        $sprint = Adm::where('cod_func', $cod_func )->where("adm_id", $adm_id)->where('data', $data)->where('categoria', 'SPRINT')->get();
        $prioritario = Adm::where('cod_func', $cod_func)->where("adm_id", $adm_id)->where('data', $data)->where('categoria', 'PRIORITARIO')->get();
        $direcionador = Adm::where('cod_func', $cod_func)->where("adm_id", $adm_id)->where('data', $data)->where('categoria', 'DIRECIONADOR')->get();

        //select
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        $sl = DB::select("SELECT DISTINCT
                        MONTH(data) as mesN,
                        DATE_FORMAT (data,'%M') as mes
                        FROM adms
                        WHERE cod_func = $cod_func
                        AND adm_id = $adm_id
                        ORDER BY mesN DESC");
        //validacoes
        if(Auth::user()->adm == 1){return view('errors.block_func');}
        if($data == 0){ return view('errors.assoc');}

         //notas
        $notas = Notas::where('cod_func', $cod_func)->where('adm_id', $adm_id)->where('data', $data)->get();

        foreach($notas as $linha){
            $cod_func = $linha->cod_func;
            $nome_func = $linha->nome_func;
        }

        //ranking
        $ranking = DB::select("SELECT DISTINCT
                                id,
                                nome_func,
                                data,
                                notaFinal,
                                adm_id,
                                @curRank := @curRank + 1 AS rank
                                FROM rankings p,
                                (SELECT @curRank := 0) r
                                WHERE adm_id = $adm_id
                                AND data = '$data'
                                ORDER BY notaFinal DESC");


        $col = DB::select("SELECT *
                        FROM
                            (SELECT DISTINCT
                            id,
                            cod_func,
                            nome_func,
                            data,
                            notaFinal,
                            adm_id,
                            @curRank := @curRank + 1 AS rank
                            FROM rankings p,
                            (SELECT @curRank := 0) r
                            WHERE adm_id = $adm_id
                            AND data = '$data'
                            ORDER BY notaFinal DESC) ranking
                        WHERE cod_func = $cod_func");


        $page = $request->input('page');
        $size = 10;
        $collect = collect($ranking);
        $ranking = new LengthAwarePaginator($collect->forPage($page, $size),$collect->count(),$size,$page);
        $ranking->setPath('');


        //destaque
        $destaque = Ranking::where('adm_id', $adm_id)->where('data', $data)->limit(3)->orderBy('notaFinal', 'DESC')->get();

        //grafico
        $top1 = $buscador->buscaTop1Ranking();
        $top1_graf = DB::select("SELECT DISTINCT
                                    data,
                                    notaFinal,
                                    adm_id
                                    FROM notas
                                    WHERE adm_id = $adm_id
                                    AND cod_func = $top1
                                    AND month(data) = $dta
                                    ORDER BY data ASC");

        $meuResult_graf = DB::select("SELECT DISTINCT
                                      data,
                                      notaFinal,
                                      adm_id
                                      FROM notas
                                      WHERE adm_id = $adm_id
                                      AND cod_func = $cod_func
                                      AND month(data) = $dta
                                      ORDER BY data ASC");

        //dd($meuResult_graf);

        if(Auth::user()->adm == 0){
            return view('dashboard.principal.index', compact( 'sprint',
                                                    'prioritario',
                                                    'direcionador',
                                                    'notas',
                                                    'ranking',
                                                    'destaque',
                                                    'top1_graf',
                                                    'meuResult_graf',
                                                    'sl',
                                                    'data',
                                                    'cod_func',
                                                    'nome_func',
                                                    'dta',
                                                    'buscador',
                                                    'col'));
        }else if(Auth::user()->adm == 1){
            return view('errors.block_func');
        }else{
            return view('errors.assoc');
        }
    }



}
