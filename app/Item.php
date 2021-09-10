<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'id',
        'cod_item',
        'nome_item',
        'obj',
        'peso',
        'rlz',
        'categoria',
        'adm_id'
    ];


}
