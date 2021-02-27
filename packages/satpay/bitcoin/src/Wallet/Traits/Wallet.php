<?php
namespace SatPay\Bitcoin\Wallet\Traits;

use App\Models\Server;
use SatPay\Bitcoin\Wallet\Exceptions\WalletExistException;
use SatPay\Bitcoin\Wallet\Exceptions\WalletDontExistException;
use SatPay\Bitcoin\Wallet\WalletCreator;
use SatPay\Bitcoin\Wallet\WalletClient;
use App\Models\Wallet as WalletModel;

trait Wallet{

    public function createWallet(Server $server){

        if($this->checkIfWalletExists()){
            throw new WalletExistException("Can't create wallet because user already has wallet.");
        }
        
        $walletCreator = new WalletCreator($server, $this);
        $walletCreator->createWallet();
        
    }

    public function checkIfWalletExists(){
        return $this->wallet()->exists();
    }

    public function getWallet(){

        if(!$this->checkIfWalletExists()){
            throw new WalletDontExistException("Wallet doesnt exist");
        }

        return new WalletClient($this);
    }
}
?>