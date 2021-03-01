<?php

namespace CoinPhon\Bitcoin\Wallet;

use App\Models\Server;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Str;
use CoinPhon\Bitcoin\RPC\RPClient;
use CoinPhon\Bitcoin\Wallet\Exceptions\WalletCreatorException;

class WalletCreator extends RPClient
{
    public $server;
    public $label;
    
    private $client;
    private $user;


    public function __construct(Server $server, User $user, $label){

        parent::__construct($server);
        $this->server = $server;
        $this->user = $user;
        $this->label = $label;

        return $this;
    }

    public function createWallet(){

        $walletName = "{$this->label}-{$this->user->id}".md5($this->user->id.Str::random(10));
    
        $response = $this->setMethod("createwallet")
            ->setParam([
                $walletName
            ])
            ->execute();


        if($response->isError()){
            throw new WalletCreatorException("REF: {$this->logId}");
        }
        
        $wallet = new Wallet([
            'label' => $this->label,
            'type_id' => 1,
            'full_label' => $walletName,
            'server_id' => $this->server->id,
        ]);
        
        $this->user->wallets()->save($wallet);

        return true;
    }



}
