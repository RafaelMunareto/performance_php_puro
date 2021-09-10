<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use App\Service\Buscador;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
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
            $data = Item::where('adm_id', $adm_id)->get();
            return response()->json($data,200);
        }else{
            $data = Item::where('adm_id', $adm_id)->paginate($paginate);
            return response()->json($data,200);
        }


    }

    public function show($id, Request $request)
    {

        $paginate = $request->paginate;

        if(Auth::user()->adm == 1){
            $adm_id = Auth::user()->cod_func;
        }else{
            $adm_id = Auth::user()->adm_id;
        }

        if($paginate == 0){
            $data = Item::where('adm_id', $adm_id)->where('cod_func',$id)->get();
            return response()->json($data);
        }else{
            $data = Item::where('adm_id', $adm_id)->where('cod_func',$id)->paginate($paginate);
            return response()->json($data);
        }

        if(!$data) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

    }

    public function store(Request $request)
    {
        $data = new Item();
        $data->fill($request->all());
        $data->save();

        return response()->json($data, 201);
    }

    public function update(Request $request, $id)
    {
        $data = Item::find($id);

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
        $data = Item::find($id);

        if(!$data) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $data->delete();
    }
}
