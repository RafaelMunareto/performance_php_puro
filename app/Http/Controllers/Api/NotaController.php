<?php

namespace App\Http\Controllers\Api;

use App\Notas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Buscador;
use Illuminate\Support\Facades\Auth;

class NotaController extends Controller
{

    public function index(Buscador $buscador, Request $request)
    {

        $date = $request->date;
        $lastDate = str_replace('-', '/', $date);
        $paginate = $request->paginate;

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

        if($paginate == 0){
            $data = Notas::where('adm_id', $adm_id)->where('data', $lastDate)->get();
            return response()->json($data,200);
        }else{
            $data = Notas::where('adm_id', $adm_id)->where('data', $lastDate)->paginate($paginate);
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
            $data = Notas::where('adm_id', $adm_id)->where('cod_func',$id)->where('data', $lastDate)->get();
            return response()->json($data,200);
        }else{
            $data = Notas::where('adm_id', $adm_id)->where('cod_func',$id)->where('data', $lastDate)->paginate($paginate);
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
        $adm = new Notas();
        $adm->fill($request->all());
        $adm->save();

        return response()->json($adm, 201);
    }

    public function update(Request $request, $id)
    {
        $data = Notas::find($id);

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
        $data = Notas::find($id);

        if(!$data) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $data->delete();
    }

}
