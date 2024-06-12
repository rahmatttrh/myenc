<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeComponentForsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function upp()
    {
        Schema::create('pe_component_fors', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->tinyInteger('group_id');
            $table->tinyInteger('designation_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function downn()
    {
        Schema::dropIfExists('pe_component_fors');
    }
}
