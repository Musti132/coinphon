<?php

namespace App\Services;

use App\Models\Wallet;
use Request;

class WalletService{

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