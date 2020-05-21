<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundamentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fundamentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('symbol_id');
            $table->string('ticker')->nullable();
            $table->string('sector')->nullable();
            $table->string('market_cap')->nullable();
            $table->string('dividend_yield')->nullable();
            $table->string('market_country')->nullable();
            $table->string('pe_ratio')->nullable();
            $table->string('price')->nullable();
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
        Schema::dropIfExists('fundamentals');
    }
}
