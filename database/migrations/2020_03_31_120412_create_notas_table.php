<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('cod_func');
            $table->string('nome_func');
            $table->float('notaSprint');
            $table->float('notaPrioritario');
            $table->float('notaDirecionador');
            $table->float('notaFinal');
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
        Schema::dropIfExists('notas');
    }
}
