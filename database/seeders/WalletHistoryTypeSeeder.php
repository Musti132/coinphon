<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class WalletHistoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'WITHDRAW'],
            ['name' => 'DEPOSIT'],
            ['name' => 'NEW_ORDER'],
            ['name' => 'ORDER_CONFIRMED'],
        ];

        DB::table('wallet_history_types')->insert($types);
    }
}
