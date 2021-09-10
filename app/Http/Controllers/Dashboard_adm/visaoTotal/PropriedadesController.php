<?php

namespace App\Http\Controllers\Dashboard_adm\visaoTotal;

use App\Adm;
use App\Http\Controllers\Controller;
use App\Service\Buscador;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class PropriedadesController extends Controller
{

    public function __construct()
    {
        $this->middleware('adm');
    }

    public function index(Request $request, int $id, Buscador $buscador, int $dta)
    {
        //data última atualizacao
        $data = $buscador->buscaMaxUpdateAdm($dta);

        $cod_func = $request->input('cod_func');

        $adm = Auth::user()->cod_func;
        $cadastro = Adm::where('adm_id', $adm)->where('data', $data)->where('cod_item', $id)->orderBy('perc', 'DESC')->get();

        $page = $request->input('page');
        $size = 7;
        $collect = collect($cadastro);
        $cadastro = new LengthAwarePaginator($collect->forPage($page, $size),$collect->count(),$size,$page);
        $cadastro->setPath("?cod_func=$cod_func");

        $datas = Adm::distinct()->select('data')->orderby('id', 'DESC')->where('adm_id', $adm)->get();

        //nome
        foreach($cadastro as $linha){
            $nome_item = $linha->nome_item;
            $cod_item = $linha->cod_item;
        }

        //gráfico
        $cem = Adm::where('adm_id', $adm)->where('data', $data)->where('cod_item', $id)->where('perc', '>=', 100)->count();
        $noventa = Adm::where('adm_id', $adm)->where('data', $data)->where('cod_item', $id)->where('perc', '>=', 90)->where('perc', '<', 100)->count();
        $oitenta = Adm::where('adm_id', $adm)->where('data', $data)->where('cod_item', $id)->where('perc', '>=', 80)->where('perc', '<', 90)->count();
        $setenta = Adm::where('adm_id', $adm)->where('data', $data)->where('cod_item', $id)->where('perc', '<', 80)->count();

        return view('dashboard_adm.visaoTotal.propriedades.index', compact('cadastro', 'nome_item', 'cem', 'noventa', 'oitenta', 'setenta', 'dta','buscador', 'cod_func', 'data', 'datas','cod_item'));
    }



}
