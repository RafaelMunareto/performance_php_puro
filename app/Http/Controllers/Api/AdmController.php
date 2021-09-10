<?php

namespace App\Http\Controllers\Api;

use App\Adm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notas;
use App\Ranking;
use App\Service\Buscador;
use Illuminate\Support\Facades\Auth;

class AdmController extends Controller
{

    public function index(Buscador $buscador, Request $request)
    {
        $excluirData = $request->excluirData;


        if(Auth::user()->adm == 1){
            $adm_id = Auth::user()->cod_func;
        }else{
            $adm_id = Auth::user()->adm_id;
        }

        if($excluirData){
            Adm::where('data', $excluirData)->where('adm_id', $adm_id)->delete();
            Ranking::where('data', $excluirData)->where('adm_id', $adm_id)->delete();
            Notas::where('data', $excluirData)->where('adm_id', $adm_id)->delete();
        }

        $date = $request->date;
        $lastDate = str_replace('-', '/', $date);
        $paginate = $request->paginate;

        if($date == 0 && Auth::user()->adm == 1 ){
            $lastDate = $buscador->buscaMaxDataAdm();
        }else if($date == 0 && Auth::user()->adm == 0) {
            $lastDate = $buscador->buscaMaxDataEquipe();
        }


        if($paginate == 0){
            if($request->cod_item){
                $data = Adm::where('adm_id', $adm_id)->where('data', $lastDate)->where('cod_item', $request->cod_item)->orderBy('perc', 'desc')->get();
                return response()->json($data,200);
            }
            $data = Adm::where('adm_id', $adm_id)->where('data', $lastDate)->get();
            return response()->json($data,200);
        }else{
            if($request->cod_item){
                $data = Adm::where('adm_id', $adm_id)->where('data', $lastDate)->where('cod_item', $request->cod_item)->orderBy('perc', 'desc')->paginate($paginate);
                return response()->json($data,200);
            }
            $data = Adm::where('adm_id', $adm_id)->where('data', $lastDate)->paginate($paginate);
            return response()->json($data,200);
        }


    }

    public function show($id, Buscador $buscador, Request $request)
    {
        $date = $request->date;
        $lastDate = str_replace('-', '/', $date);
        $paginate = $request->paginate;

        if($date == 0 && Auth::user()->adm == 1 ){
             $lastDate = $buscador->buscaMaxDataAdmId($id);
        }else if($date == 0 && Auth::user()->adm == 0 ){
            $lastDate = $buscador->buscaMaxDataEquipeId($id);
        }

        if(Auth::user()->adm == 1){
            $adm_id = Auth::user()->cod_func;
        }else{
            $adm_id = Auth::user()->adm_id;
        }

        if($paginate == 0){
            if($request->cod_item){
                $data = Adm::where('adm_id', $adm_id)->where('cod_func',$id)->where('data', $lastDate)->where('cod_item', $request->cod_item)->get();
                return response()->json($data,200);
            }
            $data = Adm::where('adm_id', $adm_id)->where('cod_func',$id)->where('data', $lastDate)->get();
            return response()->json($data,200);
        }else{
            if($request->cod_item){
                $data = Adm::where('adm_id', $adm_id)->where('cod_func',$id)->where('data', $lastDate)->where('cod_item', $request->cod_item)->paginate($paginate);
                return response()->json($data,200);
            }
            $data = Adm::where('adm_id', $adm_id)->where('cod_func',$id)->where('data', $lastDate)->paginate($paginate);
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
        $adm = new Adm();
        $adm->fill($request->all());
        $adm->save();

        return response()->json($adm, 201);
    }

    public function update(Request $request, $id)
    {

        $data = Adm::find($id);

        if(!$data) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $data->fill($request->all());

        $data->save();

        return response()->json($data,201);
    }

    public function destroy($id)
    {
        $dados = Adm::find($id);

        if(!$dados) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $dados->delete();
    }

}
