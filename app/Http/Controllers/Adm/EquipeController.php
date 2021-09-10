<?php

namespace App\Http\Controllers\Adm;

use App\Func;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestEquipe;
use App\Http\Requests\RequestEquipe_editar;
use App\Service\Buscador;
use App\Service\CadastroCreate;
use App\Service\CadastroPut;
use App\Service\CadastroRemove;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('adm');
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $cadastro = Func::where("adm_id", Auth::user()->cod_func)
                        ->where(function ($query) use ($search){
                            $query->where('cod_func', 'like', '%'.$search.'%')
                            ->orWhere('nome', 'like', '%'.$search.'%');
                        })
                        ->orderBy('id','desc')
                        ->paginate(10)->onEachSide(1);

        return view('administrativo.equipe.index' , compact('cadastro', 'search'));
    }

    public function adicionar()
    {
        return view('administrativo.equipe.adicionar_equipe');
    }

    public function store(RequestEquipe $request, CadastroCreate $cadastroCreate){

        $check = Func::where('adm_id', Auth::user()->cod_func)
                        ->where(function ($query) use($request){
                            $query->where(['cod_func' => $request->cod_func1])
                            ->orWhere(['cod_func' => $request->cod_func2 ])
                            ->orWhere(['cod_func' => $request->cod_func3 ])
                            ->orWhere(['cod_func' => $request->cod_func4 ])
                            ->orWhere(['cod_func' => $request->cod_func5 ]);
                        })
                        ->get();

        if(!isset($check[0])){
            $cadastroCreate->createFunc(
                $request->cod_func,
                $request->nome_func,
                $request
            );

            return redirect()->route('adm.equipe')
            ->with('success','Funcionário(s) cadastrado(s) com sucesso!');
        }else{
            return redirect()->route('adm.equipe')
            ->with('error','Funcionário já cadastrado!');
        }

        return redirect()->route('adm.equipe')
        ->with('success','Funcionário(s) cadastrado(s) com sucesso!');
    }

    public function destroy(Request $request, CadastroRemove $cadastroRemove, Buscador $buscador)
    {

        $cod_func = $buscador->buscaFuncbyId($request->id);
        $cadastroRemove->removeFunc($request->id, $cod_func);

        return redirect()->route('adm.equipe')
        ->with('success','Funcionário ' . $request->nome . " " . ' excluído com sucesso!');
    }

    public function editar(Request $request, int $id)
    {
        $cadastro = Func::where('id', $id)->get();

        foreach($cadastro as $linha){
            $nome_func = $linha->nome;
        }
        return view('administrativo.equipe.editar_equipe', compact('cadastro', 'nome_func'));
    }


    public function put(RequestEquipe_editar $request, Int $id, CadastroPut $cadastroPut){

        $cadastroPut->putFunc($id, $request);

        return redirect()->route('adm.equipe')
        ->with('success','Funcionário ' . $request->nome . ' alterado com sucesso!');
    }

}
