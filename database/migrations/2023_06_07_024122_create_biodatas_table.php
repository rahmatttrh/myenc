<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodatasTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('biodatas', function (Blueprint $table) {
         $table->id();
         $table->string('status')->nullable();
         $table->string('first_name');
         $table->string('last_name')->nullable();
         $table->string('phone')->nullable();
         $table->string('email')->nullable();
         $table->string('no_ktp', 20)->nullable(); // Nomor induk Kependudukan
         $table->string('no_kk', 20)->nullable(); // Nomor Kartu Keluarga
         $table->string('no_npwp', 30)->nullable(); // Nomor NPWP
         $table->string('status_pajak', 10)->nullable();
         $table->string('alamat_ktp', 10)->nullable();
         $table->string('no_jamsostek', 30)->nullable(); // Nomor Jamsostek
         $table->string('no_bpjs_kesehatan', 30)->nullable(); // Nomor BPJS
         $table->string('gender')->nullable();
         $table->string('religion')->nullable();
         $table->date('birth_date')->nullable();
         $table->string('birth_place')->nullable();
         $table->string('marital')->nullable();
         $table->string('post_code')->nullable();
         $table->string('blood')->nullable();
         $table->string('nationality')->nullable();
         $table->string('citizenship')->nullable();
         $table->string('state')->nullable();
         $table->string('city')->nullable();
         $table->string('address')->nullable();
         $table->string('last_education')->nullable();
         $table->string('vocational')->nullable();
         $table->string('institution_name')->nullable();
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
      Schema::dropIfExists('biodatas');
   }
}
