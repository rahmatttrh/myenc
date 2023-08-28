<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePekpaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pekpa_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kpa_id');
            $table->bigInteger('kpidetail_id')->nullable();
            $table->decimal('value', 6, 2)->default(0);
            $table->integer('achievement')->default(0);
            $table->string('addtional', 1)->default(0);
            $table->string('addtional_objective')->nullable();
            $table->integer('addtional_weight', 1)->default(0);
            $table->integer('addtional_target')->nullable();
            $table->string('evidence');
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
        Schema::dropIfExists('pekpa_details');
    }
}
