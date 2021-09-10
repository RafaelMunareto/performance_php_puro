<?php

namespace App\Http\Controllers\Atualizacao;

use App\Adm;
use App\Http\Controllers\Controller;
use App\Import;
use App\Imports\Import_At_Auto;
use App\Imports\Import_prod;
use App\ImportsProd;
use App\Prod;
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

class Importar_prodController extends Controller
{

    public function index()
    {
        return view('atualizacao.importar_prod');
    }


    public function import(
                            Formatacao $formatacao,
                            CadastroCreate $cadastroCreate,
                            Request $request
    )
    {
        $file = $request->file('file');

        if($_FILES['file']['type'] != "text/csv"){
            //excel
            Prod::where('adm_id', Auth::user()->cod_func)->delete();
            if(empty($file)){ return redirect()->route('importarProd')->with('error_grande','Arquivo não inserido!');}
            Excel::import(new Import_prod, $file);
            return redirect()->route('atualizacao_success');
        }else{

            //csv txt

            $arquivo_tmp = $_FILES['file']['tmp_name'];
            if(empty($arquivo_tmp)){ return redirect()->route('importarProd')->with('error','Arquivo não inserido!');}
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
                $cod_prod = $valor[2];
                $nome_prod = $valor[3];
                $total = $valor[4];
                $abordados = $valor[5];
                $aceitos = $valor[6];
                $fechados = $valor[7];
                $adm_id = $valor[8];
                $data = $valor[9];
                $cod_sup = $valor[10];
                $nome_sup = $valor[11];

                $total = $formatacao->trocaPorPonto($total);
                $abordados = $formatacao->trocaPorPonto($abordados);
                $aceitos = $formatacao->trocaPorPonto($aceitos);
                $fechados = $formatacao->trocaPorPonto($fechados);

                if(Auth::user()->cod_func == $adm_id){
                    try{
                        $cadastroCreate->createAuto_prod(
                                            $cod_func,
                                            $nome_func,
                                            $cod_prod,
                                            $nome_prod,
                                            $total,
                                            $abordados,
                                            $aceitos,
                                            $fechados,
                                            $adm_id,
                                            $data,
                                            $cod_sup,
                                            $nome_sup);

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




