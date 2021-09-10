<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cod_func');
            $table->string('nome');
            $table->integer('adm_id')->unsigned();
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
        Schema::dropIfExists('funcs');
    }
}
