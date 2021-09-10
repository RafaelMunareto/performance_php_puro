<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prod extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'cod_func',
        'nome_func',
        'cod_prod',
        'nome_prod',
        'bloco',
        'total',
        'abordados',
        'aceitos',
        'fechados',
        'data',
        'adm_id',
        'cod_sup',
        'nome_sup'
    ];
}
