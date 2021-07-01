<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CryptoWalletTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $cryptoTypes = [
            [
                'short' => 'BTC',
                'name' => 'Bitcoin',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/9/9a/BTC_Logo.svg',
                'style' => 'bxl-bitcoin btc-color',
            ],
            [
                'short' => 'ETH',
                'name' => 'Ethereum',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Ethereum_logo_2014.svg/628px-Ethereum_logo_2014.svg.png',
                'style' => null,
            ],
            [
                'short' => 'CRT',
                'name' => 'Cryptocurrency',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/8/8b/Cryptocurrency_Logo.svg',
                'style' => null,
            ]
        ];

        DB::table('crypto_types')->insert($cryptoTypes);

        $walletTypes = [
            [
                'name' => 'Online wallet',
                'short' => 'online'
            ],
            [
                'name' => 'External wallet',
                'short' => 'external'
            ],
        ];

        DB::table('wallet_types')->insert($walletTypes);

    }
}
