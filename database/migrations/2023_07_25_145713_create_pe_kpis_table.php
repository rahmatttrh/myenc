<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeKpisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function upp()
    {
        Schema::create('pe_kpis', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->bigInteger('departement_id');
            $table->bigInteger('position_id');
            $table->string('title');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function downn()
    {
        Schema::dropIfExists('pe_kpis');
    }
}
