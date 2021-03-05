<?php

namespace CoinPhon\Bitcoin\Wallet;

use App\Models\User;
use App\Models\Server;
use App\Models\Wallet;
use CoinPhon\Bitcoin\RPC\Exceptions\WalletException;
use CoinPhon\Bitcoin\RPC\RPClient;

class WalletClient extends RPClient
{
    public const LEGACY = 'legacy';
    public const P2SH = 'p2sh-segwit';
    public const BECH32 = 'bech32';

    public $wallet;

    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
        $server = Server::find($this->wallet->server_id);
        parent::__construct($server);
    }

    public function getBalance($decimals = 7)
    {

        $request = $this->setWallet($this->wallet)
            ->setMethod("getwalletinfo")
            ->execute();

        if ($request->isError()) {
            return 0;
        }

        return number_format($request->body['balance'], $decimals);
    }

    public function loadWallet()
    {
        $request = $this->setMethod("loadwallet")
            ->setParam([
                $this->wallet->full_label
            ])
            ->execute();

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

        return $request->isError() ? $request->getError() : $request->body;
    }
}
