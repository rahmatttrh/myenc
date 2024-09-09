<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionReductionsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('transaction_reductions', function (Blueprint $table) {
         $table->id();
         $table->integer('transaction_id');
         $table->integer('location_id')->nullable();
         $table->string('month')->nullable();
         $table->integer('year')->nullable();
         $table->string('type');
         $table->string('name');
         $table->integer('value');
         $table->integer('value_real')->nullable();
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
      Schema::dropIfExists('transaction_reductions');
   }
}
