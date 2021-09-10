<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cod_func');
            $table->string('nome_func');
            $table->integer('cod_prod');
            $table->string('nome_prod');
            $table->string('bloco');
            $table->integer('total');
            $table->float('abordados',50,2);
            $table->float('aceitos', 50,2);
            $table->float('fechados',50,2);
            $table->unsignedBigInteger('adm_id');
            $table->string('data');
            $table->string('cod_sup')->nullable()->default(NULL);
            $table->string('nome_sup')->nullable()->default(NULL);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prods');
    }
}
