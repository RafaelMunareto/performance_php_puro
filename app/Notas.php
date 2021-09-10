<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'cod_func',
        'nome_func',
        'notaSprint',
        'notaPrioritario',
        'notaDirecionador',
        'notaFinal',
        'adm_id',
        'data',
        'cod_sup',
        'nome_sup'
    ];

}
