<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cod_func');
            $table->string('nome_func');
            $table->integer('cod_item');
            $table->string('nome_item');
            $table->string('categoria');
            $table->float('obj', 50,2);
            $table->float('rlz', 50,2);
            $table->float('peso');
            $table->float('pontos',20,2);
            $table->float('perc', 10,2);
            $table->integer('adm_id');
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
        Schema::dropIfExists('adms');
    }
}
