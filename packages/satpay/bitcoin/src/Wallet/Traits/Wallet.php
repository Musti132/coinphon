<?php
namespace SatPay\Bitcoin\Wallet\Traits;

use SatPay\Bitcoin\Wallet\Exceptions\WalletExistException;
use SatPay\Bitcoin\Wallet\WalletCreator;
use SatPay\Bitcoin\Wallet\WalletClient;
use App\Models\Wallet as WalletModel;

trait Wallet{

    public function createWallet($server){

        if($this->checkIfWalletExists()){
            throw new WalletExistException("Can't create wallet because user already has wallet.");
        }
        
        $walletCreator = new WalletCreator($server, $this);
        $walletCreator->createWallet();
        
    }

    public function checkIfWalletExists(){
        return WalletModel::where('user_id', $this->id)->exists();
    }

    public function getWallet(){
        dd($this->id);
        return new WalletClient($this);
    }
}
?>