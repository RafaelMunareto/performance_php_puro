<?php

namespace App\Http\Controllers\Adm;

use App\Adm;
use App\Func;
use App\Http\Controllers\Controller;
use App\Item;
use App\Service\Buscador;
use App\Service\CadastroCreate;
use App\Service\CadastroRemove;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VinculacaoController extends Controller
{

    public function __construct()
    {
        $this->middleware('adm');
    }

    public function index(Request $request, int $id)
    {

        $func = Func::where('cod_func', $id)->where('adm_id', Auth::user()->cod_func)->get();
        $search = $request->search;
        $cadastro = Item::where('adm_id', Auth::user()->cod_func)
                        ->where(function ($query) use ($search){
                            $query->where('cod_item', 'like', '%'.$search.'%')
                            ->orWhere('nome_item', 'like', '%'.$search.'%')
                            ->orWhere('categoria', 'like', '%'.$search.'%')
                            ->orWhere('obj', 'like', '%'.$search.'%')
                            ->orWhere('categoria', 'like', '%'.$search.'%');
                        })
                        ->orderBy('id','desc')
                        ->paginate(6);


        foreach($func as $linha){
            $cod_func = $linha->cod_func;
            $nome_func = $linha->nome;
        }
        $lastDate = Adm::select('data')->where('cod_func', $id)->where('adm_id', Auth::user()->cod_func)->take(1)->orderBy('id', 'desc')->get();

        foreach($lastDate as $linha){
            $data = $linha->data;
        }


        return view('administrativo.vinculacao.index', compact('cadastro', 'nome_func', 'search', 'id','cod_func', 'data'));
    }

    public function vinculados(Request $request, int $id, Buscador $buscador)
    {
        $func = Func::where('cod_func', $id)->where('adm_id', Auth::user()->cod_func)->get();
        $search = $request->search;
        $data = $buscador->buscaMaxDataAdmId($id);
        $cadastro = Adm::where('cod_func','=', $id)
                    ->distinct()
                    ->where('data', $data)
                    ->where('adm_id', Auth::user()->cod_func)
                    ->where(function ($query) use ($search){
                        $query->where('cod_item', 'like', '%'.$search.'%')
                        ->orWhere('nome_item', 'like', '%'.$search.'%')
                        ->orWhere('categoria', 'like', '%'.$search.'%')
                        ->orWhere('obj', 'like', '%'.$search.'%')
                        ->orWhere('categoria', 'like', '%'.$search.'%');
                    })
                    ->orderBy('id','desc')
                    ->paginate(10);

        $vinc = Adm::where('cod_func','=', $id)
                    ->distinct()
                    ->where('data', $data)
                    ->where('adm_id', Auth::user()->cod_func)
                    ->get();

        foreach($func as $linha){
            $cod_func = $linha->cod_func;
            $nome_func = $linha->nome;
        }


        return view('administrativo.vinculacao.vinculados', compact('cadastro', 'nome_func', 'cod_func','search', 'id', 'vinc'));
    }



    public function vincula(Request $request, int $id, CadastroCreate $cadastroCreate, Buscador $buscador)
    {

        $adm = Auth::user()->cod_func;
        $check = $buscador->checkVinculacao($request->cod_item, $request->id, $adm);

        if($check == 0){ $cadastroCreate->createAdm($request, $adm);}
    }

    public function destroy(Request $request, CadastroRemove $cadastroRemove)
    {

       $cadastroRemove->removeVinc($request->id);
        return redirect()->back()
        ->with('success','Vinculação do item ' . $request->nome_item . ' excluído com sucesso!');
    }

}
