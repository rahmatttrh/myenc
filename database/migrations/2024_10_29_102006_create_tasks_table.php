<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('unit_id');
            $table->integer('department_id');
            $table->integer('employee_id');
            $table->integer('category_id')->nullable();
            $table->string('category')->nullable();
            $table->string('plan');
            $table->date('target')->nullable();
            $table->date('closed')->nullable();
            $table->integer('status')->nullable();
            $table->string('desc')->nullable();
            $table->string('evidence')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
