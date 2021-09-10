<?php

namespace App\Http\Controllers\Api;

use App\Ranking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Buscador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{

    public function index(Buscador $buscador, Request $request)
    {

        $date = $request->date;
        $rank = $request->rank;
        $orderby = $request->orderby;
        $lastDate = str_replace('-', '/', $date);
        $paginate = $request->paginate;

        if(!$orderby){
            $orderby = 'id';
        }

        if($date == 0 && Auth::user()->adm == 1 ){
             $lastDate = $buscador->buscaMaxDataAdm();
        }else if($date == 0 && Auth::user()->adm == 0) {
            $lastDate = $buscador->buscaMaxDataEquipe();
        }

        if(Auth::user()->adm == 1){
            $adm_id = Auth::user()->cod_func;
        }else{
            $adm_id = Auth::user()->adm_id;
        }


        if($rank){
            $data = DB::select("SELECT DISTINCT
                                id,
                                nome_func,
                                data,
                                notaFinal,
                                adm_id,
                                @curRank := @curRank + 1 AS rank
                                FROM rankings p,
                                (SELECT @curRank := 0) r
                                WHERE adm_id = $adm_id
                                AND data = '$lastDate'
                                ORDER BY notaFinal DESC");
            return response()->json($data,200);
        }

        if($paginate == 0){
            $data = Ranking::where('adm_id', $adm_id)->where('data', $lastDate)->orderByDesc($orderby)->get();
            return response()->json($data,200);
        }else if($paginate > 0){
            $data = Ranking::where('adm_id', $adm_id)->where('data', $lastDate)->orderByDesc($orderby)->paginate($paginate);
            return response()->json($data,200);
        }


    }

    public function show($id, Buscador $buscador, Request $request)
    {
        $paginate = $request->paginate;
        $orderby = $request->orderby;

        if(Auth::user()->adm == 1){
            $adm_id = Auth::user()->cod_func;
        }else{
            $adm_id = Auth::user()->adm_id;
        }

        if(!$orderby){
            $orderby = 'id';
        }

        if($paginate == 0){
            $data = Ranking::where('adm_id', $adm_id)->where('cod_func',$id)->orderByDesc($orderby)->get();
            return response()->json($data,200);
        }else{
            $data = Ranking::where('adm_id', $adm_id)->where('cod_func',$id)->orderByDesc($orderby)->paginate($paginate);
            return response()->json($data,200);
        }

        if($data = null) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

    }


    public function store(Request $request)
    {
        $adm = new Ranking();
        $adm->fill($request->all());
        $adm->save();

        return response()->json($adm, 201);
    }

    public function update(Request $request, $id)
    {
        $data = Ranking::find($id);

        if(!$data) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $data->fill($request->all());
        $data->save();

        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = Ranking::find($id);

        if(!$data) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $data->delete();
    }

}
