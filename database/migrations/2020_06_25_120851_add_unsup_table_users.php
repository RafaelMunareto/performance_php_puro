<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnsupTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('funcs', function (Blueprint $table) {
            $table->string('cod_sup');
            $table->string('nome_sup');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funcs', function (Blueprint $table) {
            $table->string('cod_sup');
            $table->string('nome_sup');
        });
    }
}
