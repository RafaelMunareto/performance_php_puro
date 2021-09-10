<?php

namespace App\Service;

use App\Func;
use App\Adm;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Formatacao {

    public function stringToFloat(string $valor):float
    {
        $float = str_replace('.', '', $valor);
        $float = str_replace(',', '.', $float);
        return (float)$float;
    }

    public function trocaPorPonto(string $valor):float
    {
        $float = str_replace(',', '.', $valor);
        return (float)$float;
    }

    public function formataData(string $valor):string
    {
        $data = str_replace('/', '-', $valor);
        $data = date('d/m/y',strtotime($data));

        return $data;
    }

    public function stringToInt($valor):int
    {
        return (int)$valor;
    }

    public function arrayToFloat(array $valor):float
    {
        $array = explode(",", $valor);
        $float = str_replace('.', '', $valor);
        $float = str_replace(',', '.', $float);
        return (float)$float;
    }

    public function number_format($valor)
    {
        return (float)$valor;
    }

}
