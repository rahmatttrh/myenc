<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function upp()
   {
      Schema::create('socials', function (Blueprint $table) {
         $table->id();
         $table->string('name');
         $table->string('logo')->nullable();
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function downn()
   {
      Schema::dropIfExists('socials');
   }
}
