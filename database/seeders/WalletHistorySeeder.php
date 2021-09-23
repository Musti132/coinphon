<?php

namespace Database\Seeders;

use App\Models\Wallet;
use App\Models\WalletHistory;
use App\Models\WalletHistoryType;
use Illuminate\Database\Seeder;

class WalletHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 100; $i++) {
            $amount = null;
            $type = WalletHistoryType::all()->random(1)->first();

            if($type->name == "WITHDRAW" || $type->name == "DEPOSIT"){
                $amount = mt_rand(1, 999).".".mt_rand(1, 99);
            }

            $typeId = $type->id;

            $data = [
                'wallet_id' => Wallet::all()->random(1)->first()->uuid,
                'type_id' => $typeId,
                'amount' => $amount
            ];

            WalletHistory::create($data);
        }
    }
}
