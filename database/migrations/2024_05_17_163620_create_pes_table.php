<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employe_id');
            $table->date('date')->default('2024-01-01');
            $table->integer('achievement')->default(0);
            $table->string('status', 3)->default('0');
            $table->text('alasan_reject')->nullable();  // Alasan Reject dari manager
            $table->dateTime('release_at')->nullable();
            $table->dateTime('resend_at')->nullable(); // Untuk merevisi dan mengirim kembali
            $table->dateTime('verifikasi_at')->nullable();
            $table->dateTime('validasi_at')->nullable();
            $table->string('created_by')->nullable();
            $table->string('verifikasi_by')->nullable(); // Manager & Asmen
            $table->string('validasi_by')->nullable();  // HRD
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pes');
    }
}
