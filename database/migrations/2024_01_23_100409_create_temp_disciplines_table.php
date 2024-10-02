<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempDisciplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_disciplines', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employe_id');
            $table->date('date'); // tanggal untuk bulan 
            $table->string('bulan', 2)->nullable();
            $table->string('tahun', 4)->nullable();
            $table->unsignedTinyInteger('alpa')->default(0);
            $table->unsignedTinyInteger('ijin')->default(0);
            $table->unsignedTinyInteger('terlambat')->default(0);
            $table->unsignedTinyInteger('achievement')->default(1);
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
        Schema::dropIfExists('temp_disciplines');
    }
}
