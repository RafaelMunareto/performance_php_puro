<?php
namespace App\Http\Controllers\Atualizacao;

use App\Adm;
use App\Func;
use App\Http\Controllers\Controller;
use App\Ranking;
use App\Service\Buscador;
use App\Service\CadastroCreate;
use App\Service\CadastroPut;
use App\Service\CadastroRemove;
use App\Service\Calculos;
use App\Service\Formatacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class Atualizacao_extController extends Controller
{

    public function __construct()
    {
        $this->middleware('adm');
    }

    public function index()
    {

        return view('atualizacao.index');
    }




}
