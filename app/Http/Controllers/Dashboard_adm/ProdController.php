<?php

namespace App\Http\Controllers\Dashboard_adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ProdController extends Controller
{
    public function __construct()
    {
        $this->middleware('adm');
    }

    public function index(int $dta)
    {

        return view('dashboard_adm.prod.index',compact('dta'));
    }



}
