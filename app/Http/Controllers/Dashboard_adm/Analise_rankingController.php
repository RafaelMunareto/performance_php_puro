<?php

namespace App\Http\Controllers\Dashboard_adm;

use App\Http\Controllers\Controller;
use App\Ranking;
use App\Service\Buscador;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Analise_rankingController extends Controller
{

    public function __construct()
    {
        $this->middleware('adm');
    }


    public function index(Request $request, Buscador $buscador, int $dta)
    {
        //variaveis
        $data = $buscador->buscaMaxUpdateAdm($dta);
        $adm = Auth::user()->cod_func;

        //select
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        $sl = DB::select("SELECT DISTINCT
                        MONTH(data) as mesN,
                        DATE_FORMAT (data,'%M') as mes
                        FROM adms
                        WHERE adm_id = $adm
                        ORDER BY mesN DESC");
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
                                WHERE adm_id = $adm
                                AND data = '$data'
                                ORDER BY notaFinal DESC");

        $page = $request->input('page');
        $size = 8;
        $collect = collect($ranking);
        $ranking = new LengthAwarePaginator($collect->forPage($page, $size),$collect->count(),$size,$page);
        $urlFull = $request->server('REQUEST_URI');
        $ranking->setPath($urlFull);

         //validacao
         if($ranking == NULL){return view('errors.assoc_adm');}


        //grafico
        $cem = Ranking::select('notaFinal')->where('adm_id', $adm)->where('data', $data)->where('notaFinal', '>=', 100)->count();
        $noventa = Ranking::select('notaFinal')->where('adm_id', $adm)->where('data', $data)->where('notaFinal', '>=', 90)->where('notaFinal', '<', 100)->count();
        $oitenta = Ranking::select('notaFinal')->where('adm_id', $adm)->where('data', $data)->where('notaFinal', '>=', 80)->where('notaFinal', '<', 90)->count();
        $setenta = Ranking::select('notaFinal')->where('adm_id', $adm)->where('data', $data)->where('notaFinal', '<', 80)->count();
        $datas = Ranking::distinct()->select('data')->orderby('id', 'DESC')->where('adm_id', $adm)->get();


        return view('dashboard_adm.ranking.index', compact('ranking','data','cem','noventa','oitenta','setenta', 'dta','datas', 'sl', 'dta', 'buscador'));
    }


}
