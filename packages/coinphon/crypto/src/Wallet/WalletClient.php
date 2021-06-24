<?php

namespace CoinPhon\Crypto\Wallet;

use App\Models\User;
use App\Models\Server;
use App\Models\Wallet;
use CoinPhon\Crypto\RPC\Exceptions\WalletException;
use CoinPhon\Crypto\RPC\RPClient;
use CoinPhon\Crypto\Wallet\Exceptions\WalletDontExistException;

class WalletClient extends RPClient
{
    public const LEGACY = 'legacy';
    public const P2SH = 'p2sh-segwit';
    public const BECH32 = 'bech32';

    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;

        $server = $this->wallet->server;
        parent::__construct($server);
    }

    public function getBalance($decimals = 7)
    {
        $request = $this->setWallet($this->wallet)
            ->setMethod("getbalance")
            ->execute();

        if ($request->isError()) {
            try{
                return $this->loadWallet();
            } catch(WalletDontExistException $e){
                return "0.0000000";
            }
        }

        return number_format($request->body, $decimals);
    }

    public function loadWallet()
    {
        $request = $this->setMethod("loadwallet")
            ->setParam([
                $this->wallet->full_label
            ])
            ->execute();
            
        throw new WalletDontExistException("Cannot find wallet");

        return $request->isError() ? $request->getError() : $request;
    }

    public function newAddress($type = self::LEGACY)
    {
        $request = $this->setWallet($this->wallet)
            ->setMethod("getnewaddress")
            ->setParam([
                'address_type' => $type,
            ])
            ->execute();

        if($request->isError()){
            
            switch($request->getErrorCode()){
                case -18:
                    throw new WalletDontExistException('Wallet does not exist');
            }

        }

        return $request->body;
    }
}
