<?php

namespace App\Service;

use App\Func;
use App\Adm;
use App\Import;
use App\ImportProd;
use App\Item;
use App\Notas;
use App\Prod;
use App\Ranking;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class CadastroCreate {

    public function createUser($request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cod_func' => $request->cod_func,
            'adm' => $request->validaAdm,
            'password' => Hash::make($request->password)
        ]);
    }

    public function createUserEquipe($request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cod_func' => $request->cod_func,
            'adm' => $request->validaAdm,
            'adm_id' => $request->adm_id,
            'password' => Hash::make($request->password)
        ]);
    }

    public function createFunc($cod_func, $nome_func, $request):void
    {

        DB::beginTransaction();

            $adm = Auth::user()->cod_func;
            $check = DB::table('funcs')
                ->where(['cod_func' => $cod_func])
                ->where(['nome' => $nome_func])
                ->get()
                ->count();

            for ($i=1; $i < 6; $i++) {
                $cod_func = 'cod_func' . $i;
                $nome_func = 'nome_func' . $i;
                if(
                    $request->$cod_func <> NULL
                    and $request->$nome_func <> NULL
                    and $check == NULL
                ){
                    Func::create([
                        'cod_func' => $request->$cod_func,
                        'nome' => $request->$nome_func,
                        'adm_id' => $adm
                    ]);
                }
            };

        DB::commit();
    }

    public function createItem($cod_item, $nome_item, $request, $formatacao):void
    {

        DB::beginTransaction();

            $adm = Auth::user()->cod_func;
            $check = Item::where(['cod_item' => $cod_item])
                            ->where(['nome_item' => $nome_item])
                            ->where('adm_id', Auth::user()->cod_func)
                            ->get()->count();

            for ($i=1; $i < 6; $i++) {
                $cod_item = 'cod_item' . $i;
                $nome_item = 'nome_item' . $i;
                $meta = 'meta' . $i;
                $peso = 'peso' . $i;
                $categoria = 'categoria' . $i;

                if(
                    $request->$cod_item <> NULL
                    and $request->$nome_item <> NULL
                    and $request->$meta <> NULL
                    and $request->$categoria <> NULL
                    and $check == NULL
                ){
                    Item::create([
                        'cod_item' => $request->$cod_item,
                        'nome_item' => $request->$nome_item,
                        'obj' => $formatacao->stringToFloat($request->$meta),
                        'peso' => $formatacao->stringToFloat($request->$peso),
                        'rlz' => 0,
                        'categoria' => $request->$categoria,
                        'adm_id' => $adm,
                    ]);
                }
            };

        DB::commit();
    }


    public function createAdm($request,$adm):Void
    {

        date_default_timezone_set('America/Sao_Paulo');
        $data = date('d/m/y',strtotime(today()));
        Notas::where('cod_func', $request->id)->where('data', $data)->where('adm_id', $adm)->delete();
        Adm::create([
            'cod_func' => $request->id,
            'nome_func' => $request->nome_func,
            'cod_item' => $request->cod_item,
            'nome_item' => $request->nome_item,
            'categoria' => $request->categoria,
            'obj' => $request->obj,
            'rlz'=>0,
            'peso' => $request->peso,
            'pontos' => 0,
            'perc'=>0,
            'adm_id' => $adm,
            'data' => $data
        ]);

    }

    public function createNotas($cod_func,$nome_func,$notaSprint,$notaPrioritario,$notaDirecionador,$notaFinal, $data):void
    {

        DB::beginTransaction();
        ini_set('max_execution_time', 800);

            date_default_timezone_set('America/Sao_Paulo');
            Notas::where('cod_func', $cod_func)->where('data', $data)->where('adm_id', Auth::user()->cod_func)->delete();
            Ranking::where('cod_func', $cod_func)->where('data', $data)->where('adm_id', Auth::user()->cod_func)->delete();

            Notas::create([
                    'cod_func' => $cod_func,
                    'nome_func' =>$nome_func,
                    'notaSprint' => $notaSprint,
                    'notaPrioritario' => $notaPrioritario,
                    'notaDirecionador' => $notaDirecionador,
                    'notaFinal' => $notaFinal,
                    'adm_id' => Auth::user()->cod_func,
                    'data' => $data
                ]);

            Ranking::create([
                'cod_func' =>$cod_func,
                'nome_func' => $nome_func,
                'notaFinal' => $notaFinal,
                'adm_id' => Auth::user()->cod_func,
                'data' => $data
            ]);

        DB::commit();

    }


    public function createAuto($cod_func,
                               $nome_func,
                               $cod_item,
                               $nome_item,
                               $categoria,
                               $obj,
                               $rlz,
                               $peso,
                               $adm,
                               $data,
                               $perc_esp,
                               $trava,
                               $cod_sup,
                               $nome_sup,
                               $calculos,
                               $formatacao,
                               $buscador,
                               $cadastroPut
    )
    {

        if($adm != Auth::user()->cod_func){
            return redirect()->route('importar')->with('error_grande','Verifique se a coluna de administrador está correta.');
        }

        DB::beginTransaction();

            Adm::where('cod_func', $cod_func)->where('data', $data)->where('cod_item',$cod_item)->where('adm_id', Auth::user()->cod_func)->delete();
            Notas::where('cod_func', $cod_func)->where('data', $data)->where('adm_id', Auth::user()->cod_func)->delete();
            Ranking::where('cod_func', $cod_func)->where('data', $data)->where('adm_id', Auth::user()->cod_func)->delete();

            if($buscador->checkFunc($cod_func) == 0){
                Func::create([
                    'cod_func' => $cod_func,
                    'nome' => $nome_func,
                    'adm_id' => $adm,
                    'cod_sup' => $cod_sup,
                    'nome_sup' => $nome_sup
                ]);
            }else{
                $cadastroPut->putFuncAt($cod_func, $nome_func);
            }

            if($buscador->checkCodItem($cod_item) == 0){
                Item::create([
                    'cod_item' => $cod_item,
                    'nome_item' => $nome_item,
                    'obj' => $obj,
                    'peso' => $peso,
                    'rlz' => $rlz,
                    'categoria' => $categoria,
                    'adm_id' => $adm,
                ]);
            }else{
                $cadastroPut->putItemsAt($cod_item, $nome_item, $obj, $peso, $categoria);
            }

            if($perc_esp > 0){
                $perc = $perc_esp;
                $pontos = $calculos->calculaPontos_esp($perc, $peso, $trava);
            }else{
                $perc = $calculos->calculoPerc($obj, $rlz);
                $pontos = $calculos->calculaPontos($obj, $rlz, $peso);
            }


            Adm::create([
                'cod_func' => $cod_func,
                'nome_func' => $nome_func,
                'cod_item' => $cod_item,
                'nome_item' => $nome_item,
                'categoria' => $categoria,
                'obj' => $obj,
                'rlz'=>$rlz,
                'peso' => $peso,
                'pontos' => $pontos,
                'perc'=>$perc,
                'adm_id' => $adm,
                'data' => $data,
                'cod_sup' => $cod_sup,
                'nome_sup' => $nome_sup
            ]);


            $notas = $calculos->calculaNotas($formatacao, $cod_func, $data);


            Notas::create([
                'cod_func' => $cod_func,
                'nome_func' =>$nome_func,
                'notaSprint' => $notas['sprint'],
                'notaPrioritario' => $notas['prioritario'],
                'notaDirecionador' => $notas['direcionador'],
                'notaFinal' => $notas['notaFinal'],
                'adm_id' => $adm,
                'data' => $data,
                'cod_sup' => $cod_sup,
                'nome_sup' => $nome_sup
            ]);

            Ranking::create([
                'cod_func' =>$cod_func,
                'nome_func' => $nome_func,
                'notaFinal' => $notas['notaFinal'],
                'adm_id' => $adm,
                'data' => $data,
                'cod_sup' => $cod_sup,
                'nome_sup' => $nome_sup
            ]);

        DB::commit();




    }

    public function createNovoDiaAt_manual($request){

        foreach($request->cod_item as $item=>$v){

            $row = ([
                'cod_func' => $request->cod_func[$item],
                'nome_func' => $request->nome_func[$item],
                'cod_item' => $request->cod_item[$item],
                'nome_item' => $request->nome_item[$item],
                'categoria' => $request->categoria[$item],
                'obj' => $request->obj[$item],
                'rlz'=> $request->rlz[$item],
                'peso' => $request->peso[$item],
                'pontos' => $request->pontos[$item],
                'perc'=> $request->perc[$item],
                'adm_id' => $request->adm_id[$item],
                'data' => $request->data[$item]
            ]);
            $check = Adm::where('cod_item', $request->cod_item[$item])
                ->where('data', $request->data[$item])
                ->where('cod_func', $request->cod_func[$item])
                ->where('adm_id', $request->adm_id[$item])->get()->count();

            if($check == 0){Adm::insert($row);}
        }
    }


    public function createAuto_prod(
                                    $cod_func,
                                    $nome_func,
                                    $cod_prod,
                                    $nome_prod,
                                    $total,
                                    $abordados,
                                    $aceitos,
                                    $fechados,
                                    $adm_id,
                                    $data,
                                    $cod_sup,
                                    $nome_sup
    ){

        if($adm_id <> Auth::user()->cod_func){
            return redirect()->route('importar')->with('error_grande','Verifique se a coluna de administrador está correta.');
        }

        Prod::create([
            'cod_func' =>$cod_func,
            'nome_func' => $nome_func,
            'cod_prod' => $cod_prod,
            'nome_prod' => $nome_prod,
            'total' =>$total,
            'abordados' => $abordados,
            'aceitos' => $aceitos,
            'fechados' => $fechados,
            'data' => $data,
            'cod_sup' => $cod_sup,
            'nome_sup' => $nome_sup

        ]);


    }

}
