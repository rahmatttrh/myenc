<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function upp()
    {
        Schema::create('pe_components', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name');
            $table->integer('weight');
            $table->string('table')->nullable();
            $table->tinyInteger('group_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pe_components');
    }
}
