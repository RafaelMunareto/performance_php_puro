<?php

namespace App\Service;

use App\Func;
use App\Adm;
use App\Item;
use App\Notas;
use App\Ranking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Cloner\Data;

class Buscador {

    public function checkFunc($cod_func)
    {
        $busca = Func::where('cod_func', $cod_func)->where('adm_id', Auth::user()->cod_func)->count();

        if($busca == null){
            return 0;
        }else{
            return 1;
        }
    }

    public function buscaNome(int $cod_func){
        $busca = Func::where('cod_func', $cod_func)->where('adm_id', Auth::user()->cod_func)->get();

        foreach($busca as $linha){
            return $linha->nome;
        }
    }

    public function buscaItembyId(int $id)
    {
        $cod_item = Item::where('id', $id)->get();

        foreach($cod_item as $linha){
            $item = $linha->cod_item;
            return $item;
        }
    }

    public function buscaFuncbyId(int $id):int
    {
        $cod_item = Func::where('id', $id)->get();

        if($cod_item <> null){
            foreach($cod_item as $linha){
                $cod_func = $linha->cod_func;
                return $cod_func;
            }
        }else{
            return 0;
        }
    }

    public function checkCodItem(int $cod_item):int
    {
        $busca = Item::where('cod_item', $cod_item)->where('adm_id', Auth::user()->cod_func)->count();

        if($busca == null){
            return 0;
        }else{
            return 1;
        }
    }

    public function checkVinculacao($cod_item, $id, $adm)
    {
        return Adm::where('cod_item', $cod_item)->where('cod_func', $id)->where('adm_id', $adm)->count();
    }

    public function buscaObjAdmbyItem($item, $formatacao):float
    {
        $cod_item = Item::where('cod_item', $item)->get();
        foreach($cod_item as $linha){
            $obj = $formatacao->stringToFloat($linha->obj);
        }
        return $obj;
    }

    public function buscaRlzAdmbyItem($item, $formatacao):float
    {
        $cod_item = Adm::where('cod_item', $item)->get();

        foreach($cod_item as $linha){
            $rlz = $formatacao->stringToFloat($linha->rlz);
        }
        return $rlz;
    }

    public function buscaPesoAdmbyItem($item, $formatacao):string
    {
        $cod_item = Adm::where('cod_item', $item)->get();

        foreach($cod_item as $linha){
            return $peso = $formatacao->stringToFloat($linha->peso);
        }
        return $peso;
    }

    public function buscaAdmbyAuth():int
    {
        $adm = Adm::select('adm_id', 'cod_func')->distinct()->where('cod_func', Auth::user()->cod_func)->get();
        foreach($adm as $linha){return $adm = $linha->adm_id;}
    }

    public function buscaMaxUpdate(int $id):string
    {
        $cod_func = Auth::user()->cod_func;
        $adm_id = Auth::user()->adm_id;
        $max_update = DB::select("SELECT MAX(data) as maxData FROM adms WHERE MONTH(data) = $id AND cod_func = $cod_func AND adm_id = $adm_id");
        foreach($max_update as $linha){$max_update = $linha->maxData;}

        if(is_null($max_update)){return 0;};

        return $max_update;

    }

    public function buscaMaxUpdateAdm(int $dta):string
    {
        $cod_func = Auth::user()->cod_func;
        $max_update = DB::select("SELECT MAX(data) as maxData FROM adms WHERE MONTH(data) = $dta AND adm_id = $cod_func");
        foreach($max_update as $linha){$max_update = $linha->maxData;}

        if(is_null($max_update)){return 0;};

        return $max_update;
    }

    public function buscaMaxUpdateEquipe(int $dta):string
    {
        $cod_func = Auth::user()->adm_id;
        $max_update = DB::select("SELECT MAX(data) as maxData FROM adms WHERE MONTH(data) = $dta AND adm_id = $cod_func");
        foreach($max_update as $linha){$max_update = $linha->maxData;}

        if(is_null($max_update)){return 0;};

        return $max_update;
    }


    public function buscaMaxUpdatePure():string
    {
        $max_update = Notas::where('cod_func', Auth::user()
        ->cod_func)->where('adm_id', Auth::user()->adm_id)->orderBy('updated_at', 'DESC')->take(1)->get();
        foreach($max_update as $linha){ $data = $linha->data;}
        if(is_null($data)){$data = 0;}
        return $data;
    }

    public function buscaMaxUpdateAdmPure():string
    {
        $max_update = Notas::where('adm_id', Auth::user()->cod_func)->orderBy('updated_at', 'DESC')->take(1)->get();
        foreach($max_update as $linha){ $data = $linha->data;}
        if(is_null($data)){$data = 0;}
        return $data;

    }

    public function buscaMaxDataAdm():string
    {
        $max_update = Notas::where('adm_id', Auth::user()->cod_func)->orderBy('updated_at', 'DESC')->take(1)->get();
        foreach($max_update as $linha){
            $data = $linha->data;
        }
        if(is_null($data)){$data = 0;}
        return $data;

    }

    public function buscaMaxDataEquipe():string
    {
        $max_update = Notas::where('adm_id', Auth::user()->adm_id)->orderBy('updated_at', 'DESC')->take(1)->get();
        foreach($max_update as $linha){ $data = $linha->data;}
        if(is_null($data)){$data = 0;}
        return $data;

    }

    public function buscaMaxDataAdmId($id)
    {
        $max_update = Adm::where('adm_id', Auth::user()->cod_func)->where('cod_func', $id)->orderBy('id', 'DESC')->get();
        $data = 0;
        foreach($max_update as $linha){
            $data = $linha->data;
        }
        return $data;

    }

    public function buscaMaxDataEquipeId(int $id):string
    {
        $max_update = Notas::where('adm_id', Auth::user()->adm_id)->orderBy('updated_at', 'DESC')->where('cod_func', $id)->take(1)->get();
        foreach($max_update as $linha){ $data = $linha->data;}
        if(is_null($data)){$data = 0;}
        return $data;

    }

    public function buscaMaxMes($AuthFunc, $AuthAdm_id)
    {
        $busca = DB::select("SELECT max(MONTH(data)) as maxMes FROM adms WHERE cod_func = $AuthFunc AND adm_id = $AuthAdm_id");

        foreach ($busca as $linha){
            $busca = $linha->maxMes;
        }

        return $busca;
    }

    public function buscaMaxMesAdm($AuthFunc)
    {

        $busca = DB::select("SELECT max(MONTH(data)) as maxMes FROM adms WHERE adm_id = $AuthFunc");
        if($busca == null){
            foreach ($busca as $linha){$busca = $linha->maxMes;}
            return $busca;
        }else{
            return 1;
        }
    }

    public function buscaRanking(int $cod_func)
    {
        $ranking = Ranking::where('cod_func', $cod_func)->get();
        return $ranking;
    }


    public function buscaTop1Ranking():int
    {
        $top1 = Ranking::limit(1)->orderBy('notaFinal', 'DESC')->get();
        foreach($top1 as $linha){ return $top1 = $linha->cod_func;}
    }

    public function buscaUltimoAt(){
        $busca = Adm::where('cod_func', Auth::user()->cod_func)->max('id');

        if($busca <> null){return $busca = true;}
    }

    public function buscaMes($valor)
    {

        switch ($valor) {
            case 1:
              return "JANEIRO";
            case 2:
                return "FEVEREIRO";
            case 03:
                return "MARÇO";
            case 4:
                return "ABRIL";
            case 5:
                return "MAIO";
             case 6:
                return "JUNHO";
             case 7:
                return "JULHO";
             case 8:
                return "AGOSTO";
             case 9:
                return "SETEMBRO";
             case 10:
                return "OUTUBRO";
             case 11:
                return "NOVEMBRO";
             case 12:
                return "DEZEMBRO";
        }
    }

}
