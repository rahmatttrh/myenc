<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function upp()
   {
      Schema::create('departments', function (Blueprint $table) {
         $table->smallIncrements('id');
         $table->tinyInteger('unit_id')->nullable();
         $table->string('name');
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   // public function down()
   // {
   //    Schema::dropIfExists('departments');
   // }
}
