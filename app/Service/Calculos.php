<?php

namespace App\Service;

use App\Func;
use App\Adm;
use App\Item;
use App\Notas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class Calculos {

    public function calculoPerc(float $obj, float $rlz):float
    {

        if($obj > 0 and $rlz > 0){
            $calculo = ($rlz/$obj)*100;
            return $calculo;
        }else{
            $calculo = 0;
            return $calculo;
        }
    }

    public function calculaPontos( $obj, float $rlz, $peso):float
    {
        $perc = $this->calculoPerc($obj, $rlz);
        if($perc > 120){
            $pontos = (120 * $peso)/100;
            return $pontos;
        }else if($perc < 0){
            $pontos = 0;
            return $pontos;
        }else{
            $pontos = ($perc * $peso)/100;
            return $pontos;
        }
    }

    public function calculaPontos_esp( $perc, $peso, $trava):float
    {
        if($perc > $trava){
            $pontos = ($trava * $peso);
            return $pontos;
        }else if($perc < 0){
            $pontos = 0;
            return $pontos;
        }else{
            $pontos = ($perc * $peso);
            return $pontos;
        }
    }

    public function calculaNotas(Formatacao $formatacao, int $cod_func, $dataMax):array
    {
        $adm_id = Auth::user()->cod_func;

        $pesoS = ADM::select('cod_func', DB::raw('SUM(peso) as peso'))->where('cod_func', $cod_func)->where('data', $dataMax)
                    ->where('adm_id', $adm_id)->where('categoria', 'SPRINT')->groupBy('cod_func')->get();
        foreach($pesoS as $linha){$pesoS = $linha->peso;}
        $pesoS = $formatacao->trocaPorPonto($pesoS);

        $pontosS = Adm::select('cod_func', DB::raw('SUM(pontos) as pontos'))->where('cod_func', $cod_func)->where('data', $dataMax)
                    ->where('adm_id', $adm_id)->where('categoria', 'SPRINT')->groupBy('cod_func')->get();
        foreach($pontosS as $linha){$pontosS = $linha->pontos;}
        if($pesoS == 0 or $pontosS == 0){$totalS = 0;}else{$totalS = ($pontosS);}

        $pesoP = ADM::select('cod_func', DB::raw('SUM(peso) as peso'))->where('cod_func', $cod_func)->where('data', $dataMax)
                    ->where('adm_id', $adm_id)->where('categoria', 'PRIORITARIO')->groupBy('cod_func')->get();
        foreach($pesoP as $linha){$pesoP = $linha->peso;}
        if($pesoP == null){ $pesoP = 0;}
        $pesoP = $formatacao->trocaPorPonto($pesoP);

        $pontosP = Adm::select('cod_func', DB::raw('SUM(pontos) as pontos'))->where('cod_func', $cod_func)->where('data', $dataMax)
                    ->where('adm_id', $adm_id)->where('categoria', 'PRIORITARIO')->groupBy('cod_func')->get();
        foreach($pontosP as $linha){$pontosP = $linha->pontos;}
        if($pesoP == 0 or $pontosP == 0){$totalP = 0;}else{$totalP = ($pontosP/$pesoP);}

        $pesoD = ADM::select('cod_func', DB::raw('SUM(peso) as peso'))->where('cod_func', $cod_func)->where('data', $dataMax)
                    ->where('adm_id', $adm_id)->where('categoria', 'DIRECIONADOR')->groupBy('cod_func')->get();
        foreach($pesoD as $linha){$pesoD = $linha->peso;}
        if($pesoD == null){ $pesoD = 0;}
        $pesoD = $formatacao->trocaPorPonto($pesoD);


        $pontosD = Adm::select('cod_func', DB::raw('SUM(pontos) as pontos'))->where('cod_func', $cod_func)->where('data', $dataMax)
                    ->where('adm_id', $adm_id)->where('categoria', 'DIRECIONADOR')->groupBy('cod_func')->get();
        foreach($pontosD as $linha){$pontosD = $linha->pontos;}
        if($pesoD == 0 or $pontosD == 0){$totalD = 0;}else{$totalD = ($pontosD/$pesoD);}

            $sprint = $totalS;
            $prioritario = $totalP;
            $direcionador = $totalD;

        if(!is_numeric($pontosP)){$pontosP = 0;}
        if(!is_numeric($pontosD)){$pontosD = 0;}
        if(!is_numeric($pesoP)){$pesoP = 0;}
        if(!is_numeric($pesoD)){$pesoD = 0;}
        if(!is_numeric($sprint)){$sprint = 0;}

        $notaFinal = (($pontosP + $pontosD)/($pesoD+$pesoP)) + $sprint;

        try{
            $notaFinal = (($pontosP + $pontosD)/($pesoD+$pesoP)) + $sprint;
        }catch (Throwable $e) {
            report($e);
            $notaFinal = 0;
        }

        return ['sprint'=>$sprint, 'prioritario'=> $prioritario, 'direcionador'=>$direcionador, 'notaFinal'=>$notaFinal];
    }


}
