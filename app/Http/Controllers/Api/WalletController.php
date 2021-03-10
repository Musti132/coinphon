<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\WalletCreate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Server;
use App\Helpers\Response;
use App\Repository\WalletRepository;
use App\Http\Resources\Wallet\WalletListResource;
use App\Http\Resources\Wallet\WalletShowResource;
use CoinPhon\Bitcoin\RPC\Exceptions\WalletException;
use CoinPhon\Bitcoin\Wallet\Exceptions\WalletCreatorException;
use CoinPhon\Bitcoin\Wallet\WalletClient;

class WalletController extends Controller
{
    public $walletRepository;

    public function __construct(WalletRepository $walletRepository){
        $this->walletRepository = $walletRepository;
    }

    /**
     * @return Illuminate\Http\JsonResponse
     */
    public function index(){
        
        $wallets = $this->walletRepository->allByAuthUser();
        
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
        $user = $request->user();
        $server = Server::find(1);
        $label = $request->label;
        
        try{
            $user->createWallet($server, $label);

            return Response::successMessage('Your wallet will be created shortly');
            
        } catch(WalletCreatorException $ex){
            return Response::error('Unknown error happened, please contact support. '.$ex->getMessage());
        }
    }
    
    /**
     * balance
     *
     * @param  mixed $wallet
     * @return void
     */
    public function balance(Wallet $wallet){
        $balance = $wallet->getWallet()->getBalance();

        return Response::success([
            'balance' => $balance
        ]);
    }
    
    /**
     * address
     *
     * @param  mixed $wallet
     * @return void
     */
    public function address(Wallet $wallet){
        return Response::success([
            'address' => $wallet->getWallet()->newAddress(WalletClient::BECH32),
        ]);
    }

        /**
     * address
     *
     * @param  mixed $wallet
     * @return void
     */
    public function show(Wallet $wallet){
        return Response::success(new WalletShowResource($wallet));
    }
}
