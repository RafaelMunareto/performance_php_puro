<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class unidades extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'cod_inf',
        'nome_inf',
        'cod_sup1',
        'nome_sup1',
        'cod_sup2',
        'nome_sup2',
        'cod_sup3',
        'nome_sup3',
        'uf'
    ];
}
