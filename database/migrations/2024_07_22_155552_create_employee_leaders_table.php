<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeLeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_leaders', function (Blueprint $table) {
            $table->id();
            $table->integer('unit_id');
            $table->integer('department_id')->nullable();
            $table->integer('sub_dept_id');
            $table->integer('employee_id');
            $table->integer('leader_id');
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
        Schema::dropIfExists('employee_leaders');
    }
}
