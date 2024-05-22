<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeBehaviorApprasialDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pe_behavior_apprasial_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pba_id');
            $table->bigInteger('behavior_id')->nullable();
            $table->decimal('value', 6, 2)->default(0);
            $table->integer('achievement')->default(0);
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
        Schema::dropIfExists('pe_behavior_apprasial_details');
    }
}
