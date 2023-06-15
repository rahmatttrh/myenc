<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodatasTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('biodatas', function (Blueprint $table) {
         $table->id();
         $table->string('status')->nullable();
         $table->string('first_name');
         $table->string('last_name');
         $table->string('phone')->nullable();
         $table->string('email')->nullable();
         $table->string('gender')->nullable();
         $table->string('religion')->nullable();
         $table->date('birth_date')->nullable();
         $table->string('birth_place')->nullable();
         $table->string('marital')->nullable();
         $table->string('post_code')->nullable();
         $table->string('blood')->nullable();
         $table->string('nationality')->nullable();
         $table->string('citizenship')->nullable();
         $table->string('state')->nullable();
         $table->string('city')->nullable();
         $table->string('address')->nullable();
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
      Schema::dropIfExists('biodatas');
   }
}
