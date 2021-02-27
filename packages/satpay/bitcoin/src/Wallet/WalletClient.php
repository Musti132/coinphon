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
    
    public function getBalance($decimals = 7){
        
        $request = $this->setWallet($this->user->wallet)
        ->setMethod("getwalletinfo")
        ->execute();

        return $request->isError() ? $request->getError() : number_format($request->body['balance'], $decimals);

    }

    public function loadWallet(){
        $request = $this->setMethod("loadwallet")
        ->setParam([
            $this->user->wallet->label
        ])
        ->execute();

        return $request->isError() ? $request->getError() : $request;
    }

}

?>