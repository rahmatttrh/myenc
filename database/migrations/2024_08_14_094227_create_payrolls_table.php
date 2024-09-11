<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('payrolls', function (Blueprint $table) {
         $table->id();
         // $table->integer('employee_id');
         $table->integer('location_id')->nullable();
         $table->integer('pokok');
         $table->integer('tunj_jabatan');
         $table->integer('tunj_ops');
         $table->integer('tunj_fungsional');
         $table->integer('insentif');
         $table->integer('tunj_kinerja');
         $table->integer('total');
         $table->string('doc')->nullable();
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
      Schema::dropIfExists('payrolls');
   }
}
