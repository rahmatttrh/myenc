<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsencesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('absences', function (Blueprint $table) {
         $table->id();
         $table->integer('type');
         $table->integer('employee_id');
         $table->string('month');
         $table->integer('year');
         $table->date('date');
         $table->string('desc')->nullable();
         $table->string('doc')->nullable();
         $table->integer('rate');
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
      Schema::dropIfExists('absences');
   }
}
