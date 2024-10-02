<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('in_loc')->nullable();
            $table->date('in_date')->nullable();
            $table->time('in_time')->nullable();

            $table->string('out_loc')->nullable();
            $table->date('out_date')->nullable();
            $table->time('out_time')->nullable();

            $table->time('total')->nullable();
            $table->string('pic')->nullable();
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
        Schema::dropIfExists('presences');
    }
}
