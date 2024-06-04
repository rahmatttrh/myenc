<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeDisciplineDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pe_discipline_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pd_id');
            $table->bigInteger('employe_id');
            $table->string('bulan', 2)->nullable();
            $table->string('tahun', 4)->nullable();
            $table->unsignedTinyInteger('alpa')->default(0);
            $table->unsignedTinyInteger('ijin')->default(0);
            $table->unsignedTinyInteger('terlambat')->default(0);
            $table->unsignedTinyInteger('achievement')->default(1);
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
        Schema::dropIfExists('pe_discipline_details');
    }
}
