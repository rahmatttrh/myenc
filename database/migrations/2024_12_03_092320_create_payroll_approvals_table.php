<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollApprovalsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('payroll_approvals', function (Blueprint $table) {
         $table->id();
         $table->integer('unit_transaction_id');
         $table->integer('employee_id');
         $table->string('type');
         $table->string('level');
         $table->text('desc')->nullable();
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
      Schema::dropIfExists('payroll_approvals');
   }
}
