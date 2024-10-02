<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePekpiPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return voidp
     */
    public function upp()
    {
        Schema::create('pekpi_points', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->bigInteger('pekpi_detail_id');
            $table->integer('point');
            $table->string('keterangan');
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
        Schema::dropIfExists('pekpi_points');
    }
}
