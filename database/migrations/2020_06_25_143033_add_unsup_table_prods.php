<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnsupTableProds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prods', function (Blueprint $table) {
            $table->string('cod_sup')->nullable()->default(NULL)->change();
            $table->string('nome_sup')->nullable()->default(NULL)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prods', function (Blueprint $table) {
            $table->string('cod_sup')->nullable()->default(NULL)->change();
            $table->string('nome_sup')->nullable()->default(NULL)->change();
        });
    }
}
