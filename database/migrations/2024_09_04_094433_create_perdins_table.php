<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerdinsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('perdins', function (Blueprint $table) {
         $table->id();
         $table->integer('unit_id')->nullable();
         $table->integer('location_id')->nullable();
         $table->integer('employee_id');
         $table->date('date');
         $table->string('month')->nullable();
         $table->integer('year')->nullable();
         $table->integer('value')->nullable();
         $table->text('desc')->nullable();
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
      Schema::dropIfExists('perdins');
   }
}
