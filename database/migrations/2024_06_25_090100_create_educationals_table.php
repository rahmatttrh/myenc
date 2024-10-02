<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('educationals', function (Blueprint $table) {
         $table->id();
         $table->integer('employee_id');
         $table->string('degree');
         $table->string('major')->nullable();
         $table->string('name')->nullable();
         $table->string('year');
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
      Schema::dropIfExists('educationals');
   }
}
