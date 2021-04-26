<?php
namespace CoinPhon\Bitcoin\Wallet\Traits;

use App\Models\Server;
use CoinPhon\Bitcoin\Wallet\Exceptions\WalletExistException;
use CoinPhon\Bitcoin\Wallet\Exceptions\WalletDontExistException;
use CoinPhon\Bitcoin\Wallet\WalletCreator;
use CoinPhon\Bitcoin\Wallet\WalletClient;
use App\Models\Wallet as WalletModel;

trait Wallet{


    /**
     * Create new wallet
     * @param Server $server
     * @param string $label
     */
    public function createWallet(Server $server, string $label){

        $walletCreator = new WalletCreator($server, $this, $label);

        return $walletCreator->createWallet();
    }

    /**
     * Return new instance of Wallet Client
     * @return CoinPhon\Bitcoin\Wallet\WalletClient
     */
    public function getWallet(){
        return new WalletClient($this);
    }

    public function refreshBalance(){
        $balance = $this->getWallet($this)->getBalance();

        return $balance;
    }
}
?>