<?php

namespace App\Imports;

use App\Adm;
use App\Import;
use App\Notas;
use App\Ranking;
use App\Service\CadastroCreate;
use App\Service\CadastroPut;
use App\Service\Calculos;
use App\Service\Formatacao;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Throwable;

class Import_At_Auto implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if(!is_numeric($row[5])) continue;

            $formatacao = New Formatacao;

            $cod_func = $row[0];
            $nome_func = $row[1];
            $cod_item = $row[2];
            $nome_item = $row[3];
            $categoria = $row[4];
            $obj = $formatacao->trocaPorPonto($row[5]);
            $rlz = $formatacao->trocaPorPonto($row[6]);
            $peso = $formatacao->trocaPorPonto($row[7]);
            $adm_id = (int)$row[8];
            $data =  $formatacao->formataData(gmdate("d-m-Y", (($row[9] - 25569) * 86400)));
            $perc = $formatacao->trocaPorPonto($row[10]);
            $trava = $row[11];
            $cod_sup = $row[12];
            $nome_sup = $row[13];

            Import::create([
                'cod_func' => $cod_func,
                'nome_func' => $nome_func,
                'cod_item' => $cod_item,
                'nome_item' => $nome_item,
                'categoria' => $categoria,
                'obj' => $obj,
                'peso' => $peso,
                'rlz' => $rlz,
                'adm_id' => $adm_id,
                'data' => $data,
                'perc_esp' => $perc,
                'trava' => $trava,
                'cod_sup' => $cod_sup,
                'nome_sup' => $nome_sup
            ]);

        }

        return redirect()->route('atualizar.show');

    }

}
