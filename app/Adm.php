<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adm extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'cod_func',
        'nome_func',
        'cod_item',
        'nome_item',
        'categoria',
        'obj',
        'peso',
        'rlz',
        'pontos',
        'perc',
        'adm_id',
        'data',
        'cod_sup',
        'nome_sup'
    ];



}
