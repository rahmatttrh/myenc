<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeKpasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pe_kpas', function (Blueprint $table) {
            $table->id();
            $table->integer('kpi_id');
            $table->bigInteger('employe_id');
            $table->date('date');
            $table->integer('achievement')->default(0);
            $table->string('status', 3)->default('0');
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
        Schema::dropIfExists('pe_kpas');
    }
}
