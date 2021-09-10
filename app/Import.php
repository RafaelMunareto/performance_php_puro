<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
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
        'adm_id',
        'data',
        'perc_esp',
        'trava',
        'cod_sup',
        'nome_sup'
    ];
}
