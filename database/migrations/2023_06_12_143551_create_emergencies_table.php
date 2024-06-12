<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergenciesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function upp()
   {
      Schema::create('emergencies', function (Blueprint $table) {
         $table->id();
         $table->string('name')->nullable();
         $table->string('phone')->nullable();
         $table->string('email')->nullable();
         $table->string('address')->nullable();
         $table->string('hubungan')->nullable();
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
   //    Schema::dropIfExists('emergencies');
   // }
}
