<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\WalletCreate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Server;
use App\Helpers\Response;
use App\Http\Resources\WalletListResource;
use CoinPhon\Bitcoin\RPC\RPClientResponse;
use CoinPhon\Bitcoin\Wallet\Exceptions\WalletCreatorException;
use CoinPhon\Bitcoin\Wallet\WalletClient;

class WalletController extends Controller
{
    //
    
    /**
     * index
     *
     * @return void
     */
    public function index(){
        
        $wallets = auth()->user()->wallets;
        
        return Response::success([
            'wallets' => WalletListResource::collection($wallets),
        ]);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(WalletCreate $request){

        $user = User::find($request->user()->id);
        $server = Server::find(1);
        $label = $request->label;
        
        try{
            $user->createWallet($server, $label);

            return response()->json([
                'status' => 'success',
                'message' => 'Wallet created successfully',
            ]);

        } catch(WalletCreatorException $ex){
            return response()->json([
                'status' => 'false',
                'message' => 'Unknown error happened, please contact support',
            ], 500);
        }
    }
    
    /**
     * balance
     *
     * @param  mixed $wallet
     * @return void
     */
    public function balance(Wallet $wallet){
        $balance = 0;

        $balance = $wallet->getWallet()->getBalance();

        if(isset($body['code']) && $body['code'] == RPClientResponse::NOT_LOADED){
            $wallet->getWallet()->loadWallet();
            $balance = $wallet->getWallet()->getBalance();
        }

        return $balance;
    }
    
    /**
     * address
     *
     * @param  mixed $wallet
     * @return void
     */
    public function address(Wallet $wallet){
        return $wallet->getWallet()->newAddress(WalletClient::BECH32);
    }
}
