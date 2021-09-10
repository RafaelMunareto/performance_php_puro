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

class Importar_autController extends Controller
{

    public function index()
    {
        return view('atualizacao.importar_auto');
    }


    public function import(
                            Calculos $calculos,
                            Buscador $buscador,
                            Formatacao $formatacao,
                            CadastroCreate $cadastroCreate,
                            CadastroPut $cadastroPut,
                            Request $request
    )
    {
        $file = $request->file('file');

        if($_FILES['file']['type'] != "text/csv"){
            //excel
            Import::truncate();
            if(empty($file)){ return redirect()->route('importar')->with('error_grande','Arquivo não inserido!');}
            Excel::import(new Import_At_Auto, $file);
            return redirect()->route('atualizar.show');
        }else{

            //csv txt

            $arquivo_tmp = $_FILES['file']['tmp_name'];
            if(empty($arquivo_tmp)){ return redirect()->route('importar')->with('error_grande','Arquivo não inserido!');}
            $dados = file($arquivo_tmp);
            foreach($dados as $linha){

                //Retirar os espaços em branco no inicio e no final da string
                $linha = trim($linha);
                //Colocar em um array cada item separado pela virgula na string
                $valor = explode(';', $linha);

                if(!is_numeric($valor[5])) continue;

                //Recuperar o valor do array indicando qual posição do array requerido e atribuindo para um variável
                $cod_func = $valor[0];
                $nome_func = $valor[1];
                $cod_item = $valor[2];
                $nome_item = $valor[3];
                $categoria = $valor[4];
                $obj = $valor[5];
                $rlz = $valor[6];
                $peso = $valor[7];
                $adm_id = $valor[8];
                $data = $valor[9];
                $perc = $formatacao->trocaPorPonto($valor[10]);
                $trava = $valor[11];
                $cod_sup = $valor[12];
                $nome_sup = $valor[13];
                $obj = $formatacao->trocaPorPonto($obj);
                $rlz = $formatacao->trocaPorPonto($rlz);
                $peso = $formatacao->trocaPorPonto($peso);
                $perc = $formatacao->trocaPorPonto($perc);

                if(Auth::user()->cod_func == $adm_id){
                    try{
                        $cadastroCreate->createAuto(
                                            $cod_func,
                                            $nome_func,
                                            $cod_item,
                                            $nome_item,
                                            $categoria,
                                            $obj,
                                            $rlz,
                                            $peso,
                                            $adm_id,
                                            $data,
                                            $perc,
                                            $trava,
                                            $cod_sup,
                                            $nome_sup,
                                            $calculos,
                                            $formatacao,
                                            $buscador,
                                            $cadastroPut);

                    }catch (Throwable $e) {
                        report($e);
                        return redirect()->route('atualizacao_automatica')
                        ->with('error','Há um problema no seu arquivo! Revise as colunas e o formato, se preferir envie uma mensagem no contato.');
                    }
                }else{
                    return redirect()->route('atualizacao_automatica')
                    ->with('error','Não é possível incluir metas de outros Administradores, somente para o Administrador nº ' . Auth::user()->cod_func);
                }

            }

                return redirect()->route('atualizacao_automatica')
                ->with('success','Atualização realizada com sucesso!');
        }
    }

}




