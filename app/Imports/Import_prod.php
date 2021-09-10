<?php

namespace App\Imports;

use App\Adm;
use App\Import;
use App\ImportProd;
use App\ImportsProd;
use App\Notas;
use App\Prod;
use App\Ranking;
use App\Service\CadastroCreate;
use App\Service\CadastroPut;
use App\Service\Calculos;
use App\Service\Formatacao;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Throwable;

class Import_prod implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if(!is_numeric($row[0])) continue;

            $formatacao = New Formatacao;

            $cod_func = $row[0];
            $nome_func = $row[1];
            $cod_prod = $row[2];
            $nome_prod = $row[3];
            $bloco = $row[4];
            $total = $row[5];
            $abordados = $formatacao->trocaPorPonto($row[6]);
            $aceitos = $formatacao->trocaPorPonto($row[7]);
            $fechados = $formatacao->trocaPorPonto($row[8]);
            $adm_id = (int)$row[9];
            $data =  $formatacao->formataData(gmdate("d-m-Y", (($row[10] - 25569) * 86400)));
            $cod_sup = $row[11];
            $nome_sup = $row[12];

            Prod::create([
                'cod_func' =>$cod_func,
                'nome_func' => $nome_func,
                'cod_prod' => $cod_prod,
                'nome_prod' => $nome_prod,
                'bloco' => $bloco,
                'total' =>$total,
                'abordados' => $abordados,
                'aceitos' => $aceitos,
                'fechados' => $fechados,
                'adm_id' => $adm_id,
                'data' => $data,
                'cod_sup' => $cod_sup,
                'nome_sup' => $nome_sup

            ]);

        }

        return redirect()->route('importarProd');

    }

}
