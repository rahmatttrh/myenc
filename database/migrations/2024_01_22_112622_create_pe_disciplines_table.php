<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeDisciplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pe_disciplines', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employe_id');
            $table->date('date'); // tanggal untuk bulan 
            $table->unsignedTinyInteger('alpa')->default(0);
            $table->unsignedTinyInteger('ijin')->default(0);
            $table->unsignedTinyInteger('terlambat')->default(0);
            $table->unsignedTinyInteger('achievement')->default(1);
            $table->integer('weight')->default(0);
            $table->integer('contribute_to_pe')->default(0);
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
        Schema::dropIfExists('pe_disciplines');
    }
}
