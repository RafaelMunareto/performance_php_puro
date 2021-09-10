<?php

namespace App\Http\Controllers\Dashboard_adm;

use App\Http\Controllers\Controller;
use App\Ranking;
use App\Service\Buscador;
use Illuminate\Support\Facades\Auth;

class GestaoMosaicoController extends Controller
{

    public function __construct()
    {
        $this->middleware('adm');
    }

    public function index(int $dta, Buscador $buscador)
    {
        $adm = Auth::user()->cod_func;

        $data = Ranking::distinct()->select('data')->orderby('id', 'DESC')->where('adm_id', $adm)->get();

        return view('dashboard_adm.mosaico.index', compact('dta', 'data'));
    }

}
