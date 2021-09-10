<?php

namespace App\Http\Controllers\Dashboard;

use App\Adm;
use App\Http\Controllers\Controller;
use App\Service\Buscador;
use Illuminate\Support\Facades\Auth;

class PropriedadesController extends Controller
{

    public function __construct()
    {
        $this->middleware('equipe');
    }

    public function index(int $id, Buscador $buscador, int $dta)
    {
        //data última atualizacao
        $data = $buscador->buscaMaxUpdate($dta);

        $adm = Auth::user()->adm_id;
        $cadastro = Adm::where('adm_id', $adm)->where('data', $data)->where('cod_item', $id)->orderBy('perc', 'DESC')->paginate(5)->onEachSide(1);

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

        return view('dashboard.propriedades.index', compact('cadastro', 'nome_item', 'cod_item', 'datas', 'cem', 'noventa', 'oitenta', 'setenta', 'dta','buscador'));
    }



}
