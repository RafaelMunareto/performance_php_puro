<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Func extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id',
        'cod_func',
        'nome',
        'adm_id',
        'cod_sup',
        'nome_sup'
    ];



}
