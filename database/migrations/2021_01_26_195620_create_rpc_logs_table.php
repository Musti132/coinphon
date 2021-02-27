<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRpcLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rpc_logs', function (Blueprint $table) {
            $table->id();
            $table->string('method', 14);
            $table->string('full_command');
            $table->foreignId('wallet_id')->nullable()->references('id')->on('wallets');
            $table->foreignId('server_id')->references('id')->on('servers');
            $table->timestamp('created_at', 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rpc_logs');
    }
}
