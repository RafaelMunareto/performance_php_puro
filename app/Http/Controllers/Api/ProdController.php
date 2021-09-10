<?php

namespace App\Http\Controllers\Api;

use App\Adm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notas;
use App\Prod;
use App\Ranking;
use App\Service\Buscador;
use Illuminate\Support\Facades\Auth;

class ProdController extends Controller
{

    public function index(Buscador $buscador, Request $request)
    {


        $paginate = $request->paginate;

        if(Auth::user()->adm == 1){
            $adm_id = Auth::user()->cod_func;
        }else{
            $adm_id = Auth::user()->adm_id;
        }

        if($paginate == 0){
            if($request->cod_item){
                $data = Prod::where('adm_id', $adm_id)->where('cod_prod', $request->cod_item)->get();
                return response()->json($data,200);
            }
            $data = Prod::where('adm_id', $adm_id)->get();
            return response()->json($data,200);
        }else{
            if($request->cod_item){
                $data = Prod::where('adm_id', $adm_id)->where('cod_prod', $request->cod_item)->orderBy('perc', 'desc')->paginate($paginate);
                return response()->json($data,200);
            }
            $data = Prod::where('adm_id', $adm_id)->paginate($paginate);
            return response()->json($data,200);
        }


    }

    public function show($id, Buscador $buscador, Request $request)
    {
        $paginate = $request->paginate;

        if(Auth::user()->adm == 1){
            $adm_id = Auth::user()->cod_func;
        }else{
            $adm_id = Auth::user()->adm_id;
        }

        if($paginate == 0){
            if($request->cod_item){
                $data = Prod::where('adm_id', $adm_id)->where('cod_func',$id)->where('cod_prod', $request->cod_item)->get();
                return response()->json($data,200);
            }
            $data = Prod::where('adm_id', $adm_id)->where('cod_func',$id)->get();
            return response()->json($data,200);
        }else{
            if($request->cod_item){
                $data = Prod::where('adm_id', $adm_id)->where('cod_func',$id)->where('cod_prod', $request->cod_item)->paginate($paginate);
                return response()->json($data,200);
            }
            $data = Prod::where('adm_id', $adm_id)->where('cod_func',$id)->paginate($paginate);
            return response()->json($data,200);
        }

        if(!$data) {
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

        $data = Prod::find($id);

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
        $dados = Prod::find($id);

        if(!$dados) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $dados->delete();
    }

}
