<?php

namespace App\Http\Controllers\Api;

use App\Func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Buscador;
use Illuminate\Support\Facades\Auth;

class FuncController extends Controller
{

    public function index(Request $request)
    {

        $paginate = $request->paginate;

        if(Auth::user()->adm == 1){
            $adm_id = Auth::user()->cod_func;
        }else{
            $adm_id = Auth::user()->adm_id;
        }

        if($paginate == 0){
            $data = Func::where('adm_id', $adm_id)->get();
            return response()->json($data,200);
        }else{
            $data = Func::where('adm_id', $adm_id)->paginate($paginate);
            return response()->json($data,200);
        }


    }

    public function show(int $id, Request $request)
    {

        $paginate = $request->paginate;

        $data = Func::where('id', $id)->get();
        return response()->json($data,200);

        if(!$data){
            if(Auth::user()->adm == 1){
                $adm_id = Auth::user()->cod_func;
            }else{
                $adm_id = Auth::user()->adm_id;
            }

            if($paginate == 0){
                $data = Func::where('adm_id', $adm_id)->where('cod_func',$id)->orderBy('id', 'DESC')->get();
                return response()->json($data,200);
            }else{
                $data = Func::where('adm_id', $adm_id)->where('cod_func',$id)->orderBy('id', 'DESC')->paginate($paginate);
                return response()->json($data,200);
            }

        }


        if($data = null) {

            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

    }



    public function store(Request $request)
    {
        $data = new Func();
        $data->fill($request->all());
        $data->save();

        return response()->json($data, 201);
    }


    public function update(Request $request, $id)
    {

        $data = Func::find($id);


        if(!$data) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }


        $data->update($request->all());

        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = Func::find($id);

        if(!$data) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $data->delete();
    }
}
