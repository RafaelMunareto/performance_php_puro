<?php

namespace App\Http\Controllers\Api;

use App\Adm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Prod;
use App\Service\Buscador;
use App\User;


class UserController extends Controller
{

    public function index(Request $request)
    {

        $data = User::get();
        return response()->json($data,200);

        if(!$data) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

    }

    public function show($id, Buscador $buscador, Request $request)
    {

        $data = User::where('cod_func',$id)->get();
        return response()->json($data,200);

        if(!$data) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

    }


    public function store(Request $request)
    {
        $adm = new User();
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
        $dados = User::find($id);

        if(!$dados) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $dados->delete();
    }

}
