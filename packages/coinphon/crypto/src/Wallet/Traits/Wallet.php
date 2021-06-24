<?php
namespace CoinPhon\Crypto\Wallet\Traits;

use App\Models\Server;
use CoinPhon\Crypto\Wallet\Exceptions\WalletExistException;
use CoinPhon\Crypto\Wallet\Exceptions\WalletDontExistException;
use CoinPhon\Crypto\Wallet\WalletCreator;
use CoinPhon\Crypto\Wallet\WalletClient;
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
     * @return CoinPhon\Crypto\Wallet\WalletClient
     */
    public function getWallet(){
        return new WalletClient($this);
    }

    /**
     * Get latest balance for a wallet
     * @return int
     */
    public function refreshBalance(){
        $balance = $this->getWallet($this)->getBalance();

        return $balance;
    }
}
?>