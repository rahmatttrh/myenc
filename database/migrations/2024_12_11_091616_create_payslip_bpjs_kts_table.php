<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayslipBpjsKtsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('payslip_bpjs_kts', function (Blueprint $table) {
         $table->id();
         $table->integer('status');
         $table->integer('unit_transaction_id');
         $table->string('month');
         $table->string('year');
         $table->integer('payslip_employee')->nullable();
         $table->integer('payslip_total')->nullable();

         $table->integer('payslip_bpjs_total')->nullable();
         $table->integer('iuran_company')->nullable();
         $table->integer('iuran_employee')->nullable();
         $table->integer('iuran_total')->nullable();
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
      Schema::dropIfExists('payslip_bpjs_kts');
   }
}
