<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpklsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spkls', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->integer('employee_id');
            $table->integer('department_id');
            $table->string('code')->nullable();
            $table->date('date');
            $table->time('start');
            $table->time('end');
            $table->time('total')->nullable();
            $table->string('desc');
            $table->string('loc');

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
        Schema::dropIfExists('spkls');
    }
}
