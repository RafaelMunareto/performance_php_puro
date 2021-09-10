<?php

namespace App\Http\Controllers\Dashboard_adm;

use App\Http\Controllers\Controller;

class GestaoAberturaController extends Controller
{
    public function __construct()
    {
        $this->middleware('adm');
    }

    public function index(int $dta)
    {

        return view('dashboard_adm.gestao.index', compact('dta'));
    }

}
