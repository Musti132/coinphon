<?php

namespace CoinPhon\Crypto\Wallet;

use App\Models\Server;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Str;
use CoinPhon\Crypto\RPC\RPClient;
use CoinPhon\Crypto\Wallet\Exceptions\WalletCreatorException;

class WalletCreator extends RPClient
{
    public $label;
    public $name;
    
    private $client;
    private $user;


    public function __construct(Server $server, User $user, $label){

        parent::__construct($server);
        $this->user = $user;
        $this->label = $label;

        return $this;
    }

    public function createWallet(){

        $this->name = "{$this->label}-".md5($this->user->id.Str::random(9));
        
        $response = $this->setMethod("createwallet")
            ->setParam([
                $this->name
            ])
            ->execute();


        if($response->isError()){
            throw new WalletCreatorException("REF: {$this->logId}");
        }

        return $this;
    }



}
