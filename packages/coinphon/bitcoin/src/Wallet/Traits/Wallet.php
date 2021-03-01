<?php
namespace CoinPhon\Bitcoin\Wallet\Traits;

use App\Models\Server;
use CoinPhon\Bitcoin\Wallet\Exceptions\WalletExistException;
use CoinPhon\Bitcoin\Wallet\Exceptions\WalletDontExistException;
use CoinPhon\Bitcoin\Wallet\WalletCreator;
use CoinPhon\Bitcoin\Wallet\WalletClient;
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