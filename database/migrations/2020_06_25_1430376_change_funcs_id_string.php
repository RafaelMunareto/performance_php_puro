<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFuncsIdString extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::table('funcs', function (Blueprint $table) {
            $table->nullableUuidMorphs('uuid')->change();
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
            $table->nullableUuidMorphs('uuid')->change();
        });
    }
}
