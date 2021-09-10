<?php

namespace App\Http\Controllers\Atualizacao;

use App\Adm;
use App\Http\Controllers\Controller;
use App\Import;
use App\Imports\Import_At_Auto;
use App\Service\Buscador;
use App\Service\CadastroCreate;
use App\Service\CadastroPut;
use App\Service\Calculos;
use App\Service\Formatacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class Atualizar_autController extends Controller
{

    public function index()
    {
        $verificaBase = Import::where('adm_id', Auth::user()->cod_func)->count();

        if($verificaBase > 0){
            $verificaData = Import::select('data')->where('adm_id', Auth::user()->cod_func)->limit(1)->get();
            foreach($verificaData as $linha){
                $data = $linha->data;
            }
            $progresso = Adm::where('data', $data)->where('adm_id', Auth::user()->cod_func)->count();
            $perc = ($progresso/$verificaBase)*100;
        }else{
            $verificaBase = 0;
            $progresso = 0;
            $perc = 0;
        }

        if($verificaBase == null){
            return redirect()->route('importar')->with('error_grande','O arquivo está vazio ou o Administrador é outro!');
        }

        if($perc > 100 ){
            return redirect()->route('importar')->with('error_grande','Verifique se foram inseridos corretamente todos os funcionários ou se há duplicidade.');
        }

        if($progresso == $verificaBase and $progresso > 0){
            Import::where('adm_id', Auth::user()->cod_func)->delete();
            $progresso = 'success';
        }

        if($verificaBase == 0 and $progresso == 0){
            return redirect()->route('importar');
        }

        if($progresso === 'success'){
            return redirect()->route('atualizacao_success');
        }

        return view('atualizacao.atualizar_auto', compact('verificaBase', 'progresso', 'perc'));

    }

    public function store(Request $request,CadastroCreate $cadastroCreate,Calculos $calculos,Formatacao $formatacao,Buscador $buscador,CadastroPut $cadastroPut)
    {

        $progresso = $request->progresso;
        if($progresso <= 0){$progresso = 0;}
        $import = Import::where('adm_id', Auth::user()->cod_func)->skip($progresso)->take(20)->get();

        foreach($import as $linha){

                $cadastroCreate->createAuto(
                                $linha->cod_func,
                                $linha->nome_func,
                                $linha->cod_item,
                                $linha->nome_item,
                                $linha->categoria,
                                $linha->obj,
                                $linha->rlz,
                                $linha->peso,
                                $linha->adm_id,
                                $linha->data,
                                $linha->perc_esp,
                                $linha->trava,
                                $linha->cod_sup,
                                $linha->nome_sup,
                                $calculos,
                                $formatacao,
                                $buscador,
                                $cadastroPut
                );
        }

        return redirect()->back();
    }


    public function at_success(){
        return view('atualizacao.atualizacao_success');
    }


}




