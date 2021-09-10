<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class ContatoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $dados;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

            return $this->from('contato@divflex.com.br')->cc($this->dados->email)
            ->subject("Contato Cliente " . " " . $this->dados->nome)
            ->markdown('emails.contato-markdown')
            ->with([
                'url'     => route('contato'),
            ]);


    }
}

