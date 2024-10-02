<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeBehaviorApprasialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pe_behavior_apprasials', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pe_id');
            $table->integer('achievement')->default(0);
            $table->integer('weight')->default(0);
            $table->integer('contribute_to_pe')->default(0);
            $table->string('status', 3)->default('0');
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('pe_behavior_apprasials');
    }
}
