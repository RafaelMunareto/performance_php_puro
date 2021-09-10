<?php

namespace App\Http\Controllers\Adm;

use App\Adm;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestAdm;
use App\Http\Requests\RequestAdm_editar;
use App\Item;
use App\Service\Buscador;
use App\Service\CadastroCreate;
use App\Service\CadastroPut;
use App\Service\CadastroRemove;
use App\Service\Formatacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmController extends Controller
{

    public function __construct()
    {
        $this->middleware('adm');
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $cadastro = Item::where("adm_id", Auth::user()->cod_func)
                        ->where(function ($query) use ($search){
                            $query->where('cod_item', 'like', '%'.$search.'%')
                            ->orWhere('nome_item', 'like', '%'.$search.'%')
                            ->orWhere('obj', 'like', '%'.$search.'%')
                            ->orWhere('categoria', 'like', '%'.$search.'%');
                        })
                        ->orderBy('id','desc')
                        ->paginate(10);

        return view('administrativo.items.index' , compact('cadastro', 'search'));
    }

    public function adicionar(){

        return view('administrativo.items.adicionar');
    }

    public function store(RequestAdm $request, CadastroCreate $cadastroCreate, Formatacao $formatacao)
    {
        $check = Item::where('adm_id', Auth::user()->cod_func)
                            ->where(['cod_item' => $request->cod_item1 ])
                            ->orWhere(['cod_item' => $request->cod_item2 ])
                            ->orWhere(['cod_item' => $request->cod_item3 ])
                            ->orWhere(['cod_item' => $request->cod_item4 ])
                            ->orWhere(['cod_item' => $request->cod_item5 ])
                            ->count();
        if(!$check){
            $cadastroCreate->createItem(
                $request->cod_item,
                $request->nome_item,
                $request,
                $formatacao
            );

            return redirect()->route('adm')
            ->with('success','Item(s) cadastrado(s) com sucesso!');
        }else{
            return redirect()->route('adm')
            ->with('error','Item já cadastrado!');
        }

    }

    public function destroy(Request $request, CadastroRemove $cadastroRemove, Buscador $buscador)
    {
        $cadastroRemove->removeItem($request->id);

        return redirect()->route('adm')
        ->with('success','Item ' . $request->nome_item . " " . ' excluído com sucesso!');
    }

    public function editar(Request $request, int $id)
    {
        $cadastro = Item::where('id', $id)->get();
        foreach($cadastro as $linha){$cod_item = $linha->cod_item;}

        return view('administrativo.items.editar', compact('cadastro', 'cod_item'));
    }

    public function put(Int $id,RequestAdm_editar $request,Formatacao $formatacao,Buscador $buscador,CadastroPut $cadastroPut)
    {

        $item = $buscador->buscaItembyId($id);

        $obj = $formatacao->stringToFloat($request->obj);
        $peso = $formatacao->stringToFloat(($request->peso));
        $data = $buscador->buscaMaxUpdateAdmPure();

        //busca resultado novo para ver se sofreu alteração no objetivo e no peso
        $check = Adm::select('obj', 'peso')->where('cod_item', $item)->where('adm_id', Auth::user()->cod_func)->where('data', $data)->get();
        foreach ($check as $linha){
            $newObj = $formatacao->stringToFloat($linha->obj);
            $newPeso = $formatacao->stringToFloat($linha->peso);
        }

        $cadastroPut->putAdm($item,$request,$obj,$peso,$data);
        $cadastroPut->putItems($id,$request,$obj,$peso);

        //validação do objetivo e do peso para ver se sofreu alteração
       if($newObj <> $obj){
        return redirect()->route('adm')
        ->with('warning','Item ' . $request->nome_item . ' alterado com sucesso! Para sensibilizar as notas e o ranking é necessário uma atualização');
       }

       if($newPeso <> $peso){
        return redirect()->route('adm')
        ->with('warning','Item ' . $request->nome_item . ' alterado com sucesso! Para sensibilizar as notas e o ranking é necessário uma atualização');
       }

        return redirect()->route('adm')
        ->with('success','Item ' . $request->nome_item . ' alterado com sucesso! Para sensibilizar as notas');

    }


}
