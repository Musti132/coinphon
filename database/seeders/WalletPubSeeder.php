<?php

namespace Database\Seeders;

use App\Models\Wallet;
use App\Models\WalletPublicKey;
use Illuminate\Database\Seeder;
use Str;

class WalletPubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wallets = Wallet::all();
        
        foreach($wallets as $wallet) {
            if($wallet->type_id != 2) continue;

            $publicKey = new WalletPublicKey([
                'key' => Str::random(124),
            ]);

            $wallet->publicKey()->save($publicKey);
        }
       
    }
}
