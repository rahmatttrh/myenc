<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReductionAdditionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reduction_additionals', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('description');
            $table->decimal('company');
            $table->decimal('employee');
            $table->integer('company_value');
            $table->integer('employee_value');
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
        Schema::dropIfExists('reduction_additionals');
    }
}
