<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('contracts', function (Blueprint $table) {
         $table->id();
         $table->string('id_no')->nullable();
         $table->integer('unit_id')->nullable();
         $table->integer('department_id')->nullable();
         $table->integer('designation_id')->nullable();
         $table->integer('shift_id')->nullable();
         $table->string('project')->nullable();
         $table->string('location')->nullable();
         $table->integer('salary')->nullable();
         $table->integer('hourly_rate')->nullable();
         $table->string('payslip')->nullable();
         $table->date('date')->nullable();
         $table->date('start')->nullable();
         $table->date('end')->nullable();
         $table->string('desc')->nullable();
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
      Schema::dropIfExists('contracts');
   }
}
