<?php
namespace SatPay\Bitcoin\Wallet;

use App\Models\User;
use App\Models\Server;
use App\Models\Wallet;
use SatPay\Bitcoin\RPC\RPClient;

class WalletClient extends RPClient{

    private $user;
    private $client;

    public function __construct(User $user){
        $this->user = $user;
        $server = Server::find($user->wallet->server_id);
        parent::__construct($server);
    }
    
    public function getBalance(){
        
        $body = $this->setWallet($this->user->wallet->label)
        //$body = $this->setWallet("supper")
        ->setMethod("getwalletinfo")
        ->execute()
        ->getBody();

        $array = json_decode($body, true);
        dd($array);
        return number_format($array['result']['balance'], 7);
    }

    public function loadWallet(){
        $body = $this->setMethod("loadwallet")
        ->setParam([
            $this->user->wallet->label
        ])
        ->execute()
        ->getBody();

        $array = json_decode($body, true);
    }

}

?>