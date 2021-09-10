<?php

namespace App\Service;

use App\Adm;
use App\Func;
use App\Historico;
use App\historico as AppHistorico;
use App\Import;
use App\Item;
use App\Notas;
use App\Ranking;
use App\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CadastroRemove {


    public function removeItem(int $id): void
    {

        DB::beginTransaction();
            $item = Item::find($id);
            $item->delete();
        DB::commit();

    }

    public function removeFunc(int $id, $cod_func): void
    {
        Func::where('id', $id)->delete();
        Adm::where('cod_func', $cod_func)->delete();
        Notas::where('cod_func', $cod_func)->delete();
        Ranking::where('cod_func', $cod_func)->delete();
    }

    public function removeVinc(int $id): void
    {
        DB::beginTransaction();
            $func = Adm::find($id);
            $func->delete();
        DB::commit();

    }

    public function removeDia($dta):void
    {
        $dta = str_replace('-', '/', $dta);
        DB::beginTransaction();
            Adm::where('adm_id', Auth::user()->cod_func)->where('data',$dta)->delete();
            Ranking::where('adm_id', Auth::user()->cod_func)->where('data',$dta)->delete();
            Notas::where('adm_id', Auth::user()->cod_func)->where('data',$dta)->delete();
            Import::truncate();
        DB::commit();
    }


}
