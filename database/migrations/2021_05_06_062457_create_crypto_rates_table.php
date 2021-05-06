<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptoRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crypto_id')->references('id')->on('wallet_types');
            $table->decimal('rate', 12, 2)->nullable();
            $table->char('currency', 6);
            $table->string('symbol', 10);
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
        Schema::dropIfExists('crypto_rates');
    }
}
