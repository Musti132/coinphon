<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountryTableSeeder::class);
        $this->call(CryptoWalletTypeSeeder::class);
        \App\Models\ServerRegion::factory(1)->create();
        \App\Models\Server::factory(1)->create();
        \App\Models\User::factory(1)->create();
        //$this->call(AttachSettingsSeeder::class);
        \App\Models\PhoneNumber::factory(1)->create();
        \App\Models\Wallet::factory(10)->create();
        //\App\Models\WalletType::factory(10)->create();
        \App\Models\Order::factory(10)->create();
        \App\Models\Transaction::factory(10)->create();
        \App\Models\Webhook::factory(10)->create();
        $this->call(AttachCryptosToWalletsSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(DeveloperSeeder::class);
    }
}
