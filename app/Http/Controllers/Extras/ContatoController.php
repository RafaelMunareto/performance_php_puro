<?php

namespace App\Http\Controllers\Extras;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestContato;
use App\Mail\ContatoEmail;
use Illuminate\Support\Facades\Mail;
use Swift_TransportException;

class ContatoController extends Controller
{
    public function index()
    {
        return view('extras.contato.index');
    }

    public function send(RequestContato $request)
    {
        try{
            Mail::to('contato@divflex.com.br')->send(new ContatoEmail($request));
            return redirect()->route('contato')
            ->with('success','E-mail enviado com sucesso! Retornamos em breve.');
        }catch(Swift_TransportException $e){
            return redirect()->route('contato')
            ->with('error','Tivemos um problema, por favor tente mais tarde!');
        }
    }
}
