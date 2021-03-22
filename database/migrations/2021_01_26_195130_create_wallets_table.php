<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('label', 64);
            $table->string('full_label', 64);
            $table->foreignId('type_id')->references('id')->on('wallet_types');
            $table->boolean('status')->default(1);
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignId('server_id')->references('id')->on('servers');
            $table->softDeletes();
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
        Schema::dropIfExists('wallets');
    }
}
