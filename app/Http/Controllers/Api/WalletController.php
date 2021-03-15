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
use App\Models\Webhook;
use CoinPhon\Bitcoin\RPC\Exceptions\WalletException;
use CoinPhon\Bitcoin\Wallet\Exceptions\WalletCreatorException;
use CoinPhon\Bitcoin\Wallet\WalletClient;

class WalletController extends Controller
{
    public $walletRepository;

    public $types = [
        'legacy' => WalletClient::LEGACY,
        'p2sh-segwit' => WalletClient::P2SH,
        'bech32' => WalletClient::BECH32,
    ];

    public function __construct(WalletRepository $walletRepository){
        $this->walletRepository = $walletRepository;
    }

    /**
     * @return Illuminate\Http\JsonResponse
     */
    public function index(){

        /*$webhook = Webhook::create([
            'endpoint' => 'https://dog.ceo/api/breeds/image/random'
        ]);*/

        $wallet = Wallet::find(1);

        ///$wallet->webhooks()->attach($webhook->id);

        return $wallet->webhooks;
        
        return Wallet::find(1)->webhooks;

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
        try{
            $balance = $wallet->getWallet()->getBalance();
        } catch(Exception $ex){
            return Response::error('Unknown error happened');
        }

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
    public function address(Request $request, Wallet $wallet){;
        $type = WalletClient::LEGACY;

        if(in_array($request->type, $this->types)){
            $type = $this->types[$request->type];
        }

        return Response::success([
            'address' => $wallet->getWallet()->newAddress($type),
            'expires' => now()->addHour(),
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
