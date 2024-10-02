<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeductionsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('deductions', function (Blueprint $table) {
         $table->id();
         $table->integer('employee_id');
         $table->string('option')->nullable();
         $table->string('amount')->nullable();
         $table->string('title')->nullable();
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
      Schema::dropIfExists('deductions');
   }
}
