<?php
namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Service\Buscador;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class AberturaController extends Controller
{

    public function __construct()
    {
        $this->middleware('adm');
    }

    public function index(Buscador $buscador)
    {
        $adm = Auth::user()->cod_func;
        $busca = DB::select("SELECT max(MONTH(data)) as maxMes FROM adms WHERE adm_id = $adm");

        foreach ($busca as $linha){$dta = $linha->maxMes;}
        if($dta == null){
            $dta = date('m');
        }
        return view('administrativo.abertura_adm.index', compact('dta'));

    }

}
