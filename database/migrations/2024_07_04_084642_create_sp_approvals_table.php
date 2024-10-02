<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sp_approvals', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->nullable();
            $table->integer('sp_id');
            $table->integer('employee_id');
            $table->string('type');
            $table->string('level')->nullable();
            $table->string('desc')->nullable();
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
        Schema::dropIfExists('sp_approvals');
    }
}
