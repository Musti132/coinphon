<?php
namespace SatPay\Bitcoin\Wallet\Traits;

use App\Models\Server;
use SatPay\Bitcoin\Wallet\Exceptions\WalletExistException;
use SatPay\Bitcoin\Wallet\Exceptions\WalletDontExistException;
use SatPay\Bitcoin\Wallet\WalletCreator;
use SatPay\Bitcoin\Wallet\WalletClient;
use App\Models\Wallet as WalletModel;

trait Wallet{

    public function createWallet(Server $server, $label){

        $walletCreator = new WalletCreator($server, $this, $label);

        return $walletCreator->createWallet();
    }

    public function getWallet(){
        return new WalletClient($this);
    }
}
?>