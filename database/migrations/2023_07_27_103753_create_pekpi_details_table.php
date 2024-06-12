<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePekpiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function upp()
    {
        Schema::create('pekpi_details', function (Blueprint $table) {
            $table->id();
            $table->integer('kpi_id');
            $table->string('objective');
            $table->string('kpi');
            $table->integer('weight');
            $table->integer('target');
            $table->string('priode_target');
            $table->string('metode');
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
        Schema::dropIfExists('pekpi_details');
    }
}
