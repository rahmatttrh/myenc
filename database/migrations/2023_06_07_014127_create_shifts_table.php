<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('shifts', function (Blueprint $table) {
         $table->id();
         $table->string('name');
         $table->time('in')->nullable();
         $table->time('out')->nullable();
         $table->time('total')->nullable();
         // $table->
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
      Schema::dropIfExists('shifts');
   }
}
