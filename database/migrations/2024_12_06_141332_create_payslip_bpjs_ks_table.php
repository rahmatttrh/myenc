<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayslipBpjsKsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('payslip_bpjs_ks', function (Blueprint $table) {
         $table->id();
         $table->integer('status');
         $table->integer('unit_transaction_id');
         $table->string('month');
         $table->string('year');
         $table->integer('payslip_employee');
         $table->integer('payslip_total');

         $table->integer('payslip_bpjs_total');
         $table->integer('iuran_company');
         $table->integer('iuran_employee');
         $table->integer('iuran_total');
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
      Schema::dropIfExists('payslip_bpjs_ks');
   }
}
