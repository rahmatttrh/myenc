<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sps', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->nullable();
            $table->string('status', 3)->default('0');
            $table->integer('employee_id');
            $table->integer('department_id');
            $table->integer('by_id');
            $table->integer('pe_id')->nullable();
            $table->string('tahun', 4)->nullable();
            $table->string('semester', 1)->nullable();
            $table->date('date_from');
            $table->date('date_to');
            $table->string('level');
            $table->string('desc');
            $table->string('rule')->nullable();
            $table->integer('by')->nullable();
            $table->text('alasan_reject')->nullable();
            $table->dateTime('release_at')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('reject_at')->nullable();
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
        Schema::dropIfExists('sps');
    }
}
