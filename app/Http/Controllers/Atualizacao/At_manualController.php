<?php
namespace App\Http\Controllers\Atualizacao;

use App\Adm;
use App\Func;
use App\Http\Controllers\Controller;
use App\Ranking;
use App\Service\Buscador;
use App\Service\CadastroCreate;
use App\Service\CadastroPut;
use App\Service\CadastroRemove;
use App\Service\Calculos;
use App\Service\Formatacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class At_manualController extends Controller
{

    public function __construct()
    {
        $this->middleware('adm');
    }

    public function index(Buscador $buscador)
    {
        $dta = $buscador->buscaMaxMesAdm(Auth::user()->cod_func);

        if($dta == NULL){return view('errors.assoc_adm');}
        return view('abertura_adm.index', compact('dta'));
    }

    public function atualizacao_manual(Request $request, int $id, Buscador $buscador, Formatacao $formatacao)
    {
        //datas
        $dta = $request->input('dta');
        $dtaDelete = str_replace('/', '-', $dta);
        $dta_ajax = str_replace('/', '', $dta);
        $data = date('d/m/y',strtotime(today()));

        $sl = Ranking::select('data')->distinct()->orderBy('created_at', 'desc')->get();
        $maxSl = Ranking::select('data')->distinct()->orderBy('created_at', 'desc')->limit(1)->get();
        foreach($maxSl as $linha){$maxData = $linha->data;}

        //validacao
        if($dta == NULL){$dta = $buscador->buscaMaxDataAdm();}
        if($dtaDelete == NULL){$dtaDelete = str_replace('/', '-', $maxData);}

        //dados
        $func = Func::where('adm_id', Auth::user()->cod_func)->get();
        $atualizacao = Adm::join('funcs', 'funcs.cod_func', '=', 'adms.cod_func' )
                                ->where('adms.cod_func', $id)
                                ->where("adms.data", $dta)
                                ->where("adms.adm_id", Auth::user()->cod_func)
                                ->where("funcs.adm_id", Auth::user()->cod_func)
                                ->orderBy('adms.categoria', 'DESC')
                                ->orderBy('adms.cod_item', 'ASC')
                                ->get();


        return view('atualizacao.atualizacao_manual', compact('atualizacao', 'func', 'id', 'dta', 'sl', 'dta', 'dta_ajax', 'data', 'dtaDelete'));
    }


    public function storeNova_data(Request $request, CadastroCreate $cadastroCreate)
    {
        //validacao
        if($request->id == 0){return redirect()->back()->with('warning','Escolha um funcionário!');}
        if($request->cod_item == null){return redirect()->back()->with('warning','Escolha um dia com objetivos cadastrados para espelhar os itens!');}
        if($request->cod_item <> null){$cadastroCreate->createNovoDiaAt_manual($request);}

       return redirect()->back()->with('success','Incluído novo dia, por favor prossiga com a atualização!');
    }


    public function put (Request $request,Formatacao $formatacao,Calculos $calculos, CadastroCreate $cadastroCreate,Buscador $buscador,CadastroPut $cadastroPut):void
    {
        $data = $request->data;
        $obj = $formatacao->trocaPorPonto($request->obj);
        $rlz = $formatacao->stringToFloat($request->rlz);
        $peso = $formatacao->trocaPorPonto($request->peso);
        $cod_func = $request->id;
        $nome_func = $buscador->buscaNome($cod_func);
        $cod_item = $request->cod_item;
        $pontos = $calculos->calculaPontos($obj, $rlz, $peso);
        $perc = $calculos->calculoPerc($obj, $rlz);
        $cadastroPut->putAtualizacao($cod_item, $cod_func, $rlz, $peso, $perc, $pontos, $data);
        $notas = $calculos->calculaNotas($formatacao, $cod_func, $data);
        $cadastroCreate->createNotas($cod_func,$nome_func,$notas['sprint'],$notas['prioritario'],$notas['direcionador'],$notas['notaFinal'], $data);
    }


    public function delete($dta, CadastroRemove $cadastroRemove)
    {
        $cadastroRemove->removeDia($dta);

        return redirect()->back()->with('success', 'Dia excluído com sucesso!');
    }



}
