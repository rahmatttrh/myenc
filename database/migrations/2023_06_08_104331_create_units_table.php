<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function upp()
   {
      Schema::create('units', function (Blueprint $table) {
         $table->tinyIncrements('id');
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
   //    Schema::dropIfExists('units');
   // }
}
