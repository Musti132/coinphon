<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRpcMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rpc_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('log_id')->references('id')->on('rpc_logs');
            $table->smallInteger('error_code')->nullable();
            $table->mediumInteger('status_code');
            $table->longText('message');
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
        Schema::dropIfExists('rpc_messages');
    }
}
