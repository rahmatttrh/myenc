<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reductions', function (Blueprint $table) {
            $table->id();
            $table->integer('unit_id');
            $table->string('name');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->integer('company');
            $table->integer('employee');
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
        Schema::dropIfExists('reductions');
    }
}
