<?php

namespace App\Http\Controllers\Dashboard;

use App\Adm;
use App\Http\Controllers\Controller;
use App\Item;
use App\Service\Buscador;
use App\Service\Formatacao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class Analise_itemsController extends Controller
{

    public function __construct()
    {
        $this->middleware('equipe');
    }


    public function index(Request $request, Buscador $buscador, Formatacao $formatacao, int $dta)
    {
        //variaveis
        $id = $formatacao->stringToInt($dta);
        $dta = $request->input('dta');
        $item = $request->input('item');
        $data = $buscador->buscaMaxUpdateEquipe((int)$id);
        $adm = Auth::user()->adm_id;
        //select
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        $sl = DB::select("SELECT DISTINCT
                        MONTH(data) as mesN,
                        DATE_FORMAT (data,'%M') as mes
                        FROM adms
                        WHERE adm_id = $adm
                        ORDER BY mesN DESC");
        //items
        $item_select = Item::distinct()->where('adm_id', $adm)->orderBy('nome_item', 'ASC')->get();
        $items = Adm::where('adm_id', $adm)->where('cod_item', $item)->where('data', $data)->orderBy('perc', 'DESC')->paginate(5)->onEachSide(1);
        $urlFull = $request->server('REQUEST_URI');
        $urlFull = explode("&page=", $urlFull);
        $items->setPath($urlFull[0]);

        $datas = Adm::distinct()->select('data')->orderby('id', 'DESC')->where('adm_id', $adm)->get();

        //grafico
        $cem = Adm::where('adm_id', $adm)->where('cod_item', $item)->where('data', $data)->where('perc', '>=', 100)->count();
        $noventa = Adm::where('adm_id', $adm)->where('cod_item', $item)->where('data', $data)->where('perc', '>=', 90)->where('perc', '<', 100)->count();
        $oitenta = Adm::where('adm_id', $adm)->where('cod_item', $item)->where('data', $data)->where('perc', '>=', 80)->where('perc', '<', 90)->count();
        $setenta = Adm::where('adm_id', $adm)->where('cod_item', $item)->where('data', $data)->where('perc', '<', 80)->count();

        return view('dashboard.items.index', compact('item','items','item_select','cem','noventa','oitenta','setenta', 'sl', 'datas', 'dta', 'buscador', 'id' ));
    }


}
