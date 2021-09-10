<?php namespace App\Http\Controllers\Dashboard_adm;

use App\Http\Controllers\Controller;
use App\Ranking;
use App\Service\Buscador;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class Analise_gestaoController extends Controller
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

