<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMutationsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('mutations', function (Blueprint $table) {
         $table->id();
         $table->integer('employee_id');
         $table->date('date');
         $table->integer('from_id');
         $table->integer('become_id');
         $table->string('desc');
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
      Schema::dropIfExists('mutations');
   }
}
