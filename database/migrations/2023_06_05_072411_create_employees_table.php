<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('employees', function (Blueprint $table) {
         $table->id();
         $table->integer('status')->nullable();
         $table->integer('completeness')->nullable();
         $table->string('role')->nullable();
         $table->integer('user_id')->nullable();
         $table->integer('department_id')->nullable();
         $table->integer('sub_dept_id')->nullable();
         $table->integer('designation_id')->nullable();
         $table->integer('position_id')->nullable();
         $table->integer('biodata_id')->nullable();
         $table->integer('kpi_id')->nullable();
         $table->string('nik', 50)->nullable();
         $table->date('entry_date')->nullable(); //tanggal masuk 
         $table->date('determination_date')->nullable(); // Tanggal penetapan karyawan
         // LAMA KERJA (sekarang - tanggal masuk )
         // MASA KERJA (sekarang - tanggal penetapan/determination)

         $table->integer('contract_id')->nullable();
         $table->integer('emergency_id')->nullable();
         $table->integer('direct_leader_id')->nullable();
         $table->integer('manager_id')->nullable();
         $table->string('area', 50)->nullable();
         $table->string('picture')->nullable();
         $table->string('bio')->nullable();
         $table->string('experience')->nullable();

         $table->integer('contract_id')->nullable();

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
      Schema::dropIfExists('employees');
   }
}
