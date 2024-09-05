<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('additionals', function (Blueprint $table) {
         $table->id();
         $table->integer('type');
         $table->integer('location_id')->nullable();
         $table->integer('employee_id');
         $table->string('month');
         $table->integer('year');
         $table->date('date');
         $table->integer('value');
         $table->string('desc')->nullable();
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
      Schema::dropIfExists('additionals');
   }
}
