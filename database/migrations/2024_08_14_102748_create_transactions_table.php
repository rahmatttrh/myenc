<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
<<<<<<< HEAD
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->integer('unit_id');
            $table->integer('location_id');
            $table->integer('employee_id');
            $table->integer('month');
            $table->integer('year');
            $table->integer('total');
            $table->timestamps();
        });
    }
=======
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('transactions', function (Blueprint $table) {
         $table->id();
         $table->integer('status');
         $table->integer('unit_id');
         $table->integer('location_id');
         $table->integer('employee_id');
         $table->integer('payroll_id')->nullable();
         $table->integer('month');
         $table->integer('year');
         $table->integer('overtime')->nullable();
         $table->integer('reduction')->nullable();
         $table->integer('bruto')->nullable();
         $table->integer('total');
         $table->timestamps();
      });
   }
>>>>>>> 5371422cd3838fa00e68679ea77f2f283da3fa49

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('transactions');
   }
   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('transactions');
   }
}
