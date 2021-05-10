<?php

namespace Database\Seeders;

use App\Models\CryptoType;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class AttachCryptosToWalletsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wallets = Wallet::all();
        
        foreach($wallets as $wallet){
            $random = CryptoType::all()->random(1)->first()->id;
            $wallet->types()->attach([
                $random
            ]);
        }
    }
}
