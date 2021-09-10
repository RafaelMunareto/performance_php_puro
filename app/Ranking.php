<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'id',
        'ranking',
        'cod_func',
        'nome_func',
        'notaFinal',
        'adm_id',
        'data',
        'cod_sup',
        'nome_sup'
    ];

}
