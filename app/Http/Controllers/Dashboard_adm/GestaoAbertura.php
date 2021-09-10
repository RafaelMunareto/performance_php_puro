<?php

namespace App\Http\Controllers\Dashboard_adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GestaoAbertura extends Controller
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
