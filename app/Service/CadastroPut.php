<?php

namespace App\Service;

use App\Func;
use App\Adm;
use App\Item;
use App\Notas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CadastroPut {

    public function putAtualizacao($cod_item,$cod_func,$rlz,$peso,$perc,$pontos, $data):void
    {
        date_default_timezone_set('America/Sao_Paulo');
        $adm = Auth::user()->cod_func;
        Adm::where('cod_item', $cod_item)
            ->where('cod_func', $cod_func)
            ->where('data', $data)
            ->where('adm_id', $adm)
            ->update([
                'rlz' => $rlz,
                'peso' => $peso,
                'perc' => $perc,
                'pontos' => $pontos,
                'data' => $data,
                'adm_id' => $adm

            ]);

    }

    public function putAdm($item,$request,$obj,$peso,$data):void
    {
        date_default_timezone_set('America/Sao_Paulo');
        $adm = Auth::user()->cod_func;
        Adm::where('cod_item', $item)
            ->where('adm_id', $adm)
            ->where('data', $data)
            ->update(array(
                'cod_item'=>$request->cod_item,
                'nome_item'=> $request->nome_item,
                'obj'=> $obj,
                'peso'=> $peso,
                'categoria'=>$request->categoria,
                'data' => $data,
                'adm_id' => $adm
            ));

    }

    public function putAdmPercPontos($item, $perc, $pontos):void
    {
        $adm = Auth::user()->cod_func;
        Adm::where('cod_item', $item)
            ->where('adm_id', $adm)
            ->update(array(
                'perc' => $perc,
                'pontos' => $pontos,
                'adm_id' => $adm
        ));

    }

    public function putItems($id,$request,$obj,$peso):void
    {
        $adm = Auth::user()->cod_func;
        Item::where('id', $id)
            ->where('adm_id', $adm)
            ->update(array(
                'cod_item'=>$request->cod_item,
                'nome_item'=> $request->nome_item,
                'obj'=> $obj,
                'peso'=> $peso,
                'rlz'=> 0,
                'categoria'=>$request->categoria,
                'adm_id' => $adm
        ));
    }

    public function putFunc($id, $request):void
    {
        $adm = Auth::user()->cod_func;
        Func::where('id', $id)
            ->where('adm_id', $adm)
            ->update(array(
                'cod_func'=>$request->cod_func,
                'nome'=> $request->nome,
                'adm_id' => $adm
            ));
    }

    public function putItemsAt($cod_item,$nome_item,$obj,$peso,$categoria):void
    {
        $adm = Auth::user()->cod_func;
        Item::where('cod_item', $cod_item)
            ->where('adm_id', $adm)
            ->update(array(
                'cod_item'=>$cod_item,
                'nome_item'=> $nome_item,
                'obj'=> $obj,
                'peso'=> $peso,
                'categoria' =>$categoria,
                'adm_id' => $adm

        ));
    }

    public function putFuncAt($cod_func, $nome_func):void
    {
        $adm = Auth::user()->cod_func;
        Func::where('cod_func', $cod_func)
            ->where('adm_id', $adm)
            ->update(array(
                'cod_func'=>$cod_func,
                'nome'=> $nome_func,
                'adm_id' => $adm
            ));
    }

}
