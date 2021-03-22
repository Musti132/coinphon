<?php

namespace App\Services;

use App\Models\Wallet;
use Illuminate\Http\Request;
use CoinPhon\Bitcoin\Wallet\WalletClient;

class WalletService{

    public $types = [
        'legacy' => WalletClient::LEGACY,
        'p2sh-segwit' => WalletClient::P2SH,
        'bech32' => WalletClient::BECH32,
    ];

    public function getAddress(Request $request, Wallet $wallet){
        $type = WalletClient::LEGACY;

        if(in_array($request->type, $this->types)){
            $type = $this->types[$request->type];
        }

        return [
            'address' => $wallet->getWallet()->newAddress($type),
            'expires' => now()->addHour(),
        ];
    }


}

?>