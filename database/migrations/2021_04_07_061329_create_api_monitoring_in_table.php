<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiMonitoringInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_monitoring_in', function (Blueprint $table) {
            $table->id();
            $table->foreignId('api_key')->references('id')->on('api_keys');
            $table->smallInteger('code');
            $table->char('type', 7);
            $table->foreignId('wallet_id')->references('id')->on('wallets');
            $table->string('path', 64);
            $table->foreignId('log_id')->references('id')->on('api_logs');
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
        Schema::dropIfExists('api_monitoring_in');
    }
}
