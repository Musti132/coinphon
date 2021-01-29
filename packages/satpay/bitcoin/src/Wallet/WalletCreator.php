<?php

namespace SatPay\Bitcoin\Wallet;

use App\Models\Server;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Str;
use SatPay\Bitcoin\RPC\RPClient;

class WalletCreator extends RPClient
{
    public $server;
    private $client;
    private $user;


    public function __construct(Server $server, User $user){

        parent::__construct($server);
        $this->server = $server;
        $this->user = $user;

        return $this;
    }

    public function createWallet(){

        $walletName = "WALLET-".md5($this->user->id.Str::random(10));

        $wallet = new Wallet([
            'label' => $walletName,
            'server_id' => $this->server->id,
        ]);
        
        $this->user->wallet()->save($wallet);
    
        $this->setMethod("createwallet")
            ->setParam([
                $walletName
            ])
            ->execute();
    }



}
