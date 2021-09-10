<?php

namespace App\Http\Controllers\Dashboard_adm\visaoTotal;

use App\Adm;
use App\Func;
use App\Http\Controllers\Controller;
use App\Notas;
use App\Ranking;
use App\Service\Buscador;
use App\Service\Calculos;
use App\Service\Formatacao;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('adm');
    }

    public function index(Request $request, Calculos $calculos, Formatacao $formatacao, Buscador  $buscador, int $dta)
    {

        //variaveis
        $data = $buscador->buscaMaxUpdateAdm($dta);
        $adm_id = Auth::user()->cod_func;

        //escolhe funcionario
        $sl_func = Func::distinct()->select('cod_func', 'nome')->where('adm_id', Auth::user()->cod_func)->get();
        $cod_func = $request->input('cod_func');

        if($cod_func == null){
            $busca = Ranking::distinct()->where('adm_id', Auth::user()->cod_func)->where('data',$data)->take(1)->orderByDesc('notaFinal')->get();
            foreach($busca as $linha){
                $cod_func = $linha->cod_func;
            }
        }

        $func = Func::distinct()->where('cod_func', $cod_func)->take(1)->get();
        foreach($func as $linha){$nome_func = $linha->nome;}

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
                        WHERE adm_id = $adm_id
                        ORDER BY mesN DESC");
         //notas
        $notas = Notas::where('cod_func', $cod_func)->where('adm_id', $adm_id)->where('data', $data)->get();

        $datas = Notas::distinct()->select('data')->where('cod_func', $cod_func)->where('adm_id', $adm_id)->get();
        try{
              //ranking
            $ranking = DB::select("SELECT DISTINCT
                            id,
                            nome_func,
                            data,
                            cod_func,
                            notaFinal,
                            adm_id,
                            @curRank := @curRank + 1 AS rank
                            FROM rankings p,
                            (SELECT @curRank := 0) r
                            WHERE adm_id = $adm_id
                            AND data = '$data'
                            ORDER BY notaFinal DESC");
        }catch(QueryException $e){
            return view('errors.assoc');
        }



        try{
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
         }catch(QueryException $e){
            return view('errors.assoc');
        }

        $page = $request->input('page');
        $size = 10;
        $collect = collect($ranking);
        $ranking = new LengthAwarePaginator($collect->forPage($page, $size),$collect->count(),$size,$page);
        $ranking->setPath("?cod_func=$cod_func");

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



        return view('dashboard_adm.visaoTotal.principal.index', compact( 'sprint',
                                                'prioritario',
                                                'direcionador',
                                                'notas',
                                                'ranking',
                                                'destaque',
                                                'top1_graf',
                                                'meuResult_graf',
                                                'sl',
                                                'dta',
                                                'data',
                                                'datas',
                                                'buscador',
                                                'cod_func',
                                                'func',
                                                'sl_func',
                                                'nome_func',
                                                'col'));

    }
}
