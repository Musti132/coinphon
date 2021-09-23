<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Helpers\Pagination;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\WalletCreate;
use App\Http\Requests\Wallet\WalletAddressRequest;
use App\Models\Wallet;
use App\Models\Server;
use App\Helpers\Response;
use App\Http\Requests\Wallet\WalletUpdateRequest;
use App\Repository\WalletRepository;
use App\Http\Resources\Wallet\WalletListResource;
use App\Http\Resources\Wallet\WalletShowResource;
use App\Services\WalletService;
use CoinPhon\Crypto\Wallet\Exceptions\WalletCreatorException;
use CoinPhon\Crypto\Wallet\Exceptions\WalletDontExistException;
use Cache;
use Illuminate\Http\Request as Request;

class WalletController extends Controller
{
    public $walletRepository;

    public function __construct(WalletRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    /**
     * Return a list of wallets for user
     * 
     * @param Request $request
     * 
     * @return Illuminate\Http\JsonResponse
     */

    public function index(Request $request)
    {
        $page = $request->filled('page') ? $request->page : 0;

        $wallets = $this->walletRepository->allByAuthUser();

        return WalletListResource::collection($wallets->paginate(Pagination::DEFAULT_PER_PAGE, ['*'], 'page', $page))->additional([
            'status' => 'success',
        ]);
    }

    /**
     * Store new object in storage
     *
     * @param  WalletCreate $request
     * 
     * @return Illuminate\Http\JsonResponse
     */

    public function store(WalletCreate $request)
    {
        $user = $request->user();
        $server = Server::find(1);
        $label = $request->label;

        try {
            $wallet = $user->createWallet($server, $label);

            $walletObject = $this->walletRepository->createWallet($label, $wallet->name, $server->id, $request);

            //$user->wallets()->save($walletObject);

            return Response::success([
                'wallet' => new WalletShowResource($walletObject->load('cryptos'))
            ], 'Your wallet will be created shortly');
        } catch (WalletCreatorException $ex) {
            return Response::error('Unknown error happened, please contact support. ' . $ex->getMessage());
        }
    }

    /**
     * Grab wallet balance and return it
     *
     * @param  App\Models\Wallet $wallet
     * 
     * @return Illuminate\Http\JsonResponse
     */

    public function balance(Wallet $wallet)
    {
        try {
            $balance = $wallet->refreshBalance();
            Cache::put('wallet_' . $wallet->uuid, $balance, now()->addSeconds(config('cache.wallet_balance_ttl')));
        } catch (Exception $ex) {
            return Response::error('Couldnt get balance');
        }

        return Response::success([
            'balance' => $balance
        ]);
    }

    /**
     * Return wallet status and balance
     * 
     * @param App\Models\Wallet $wallet
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function status(Wallet $wallet){
        try {
            $balance = $wallet->refreshBalance();
            Cache::put('wallet_' . $wallet->uuid, $balance, now()->addSeconds(config('cache.wallet_balance_ttl')));
        } catch (Exception $ex) {
            return Response::error('Couldnt get balance');
        }
        
        return Response::success([
            'status' => $wallet->status,
            'balance' => $balance,
        ]);
    }

    /**
     * Generate an address for wallet
     *
     * @param  App\Models\Wallet $wallet
     * 
     * @return Illuminate\Http\JsonResponse
     */

    public function address(WalletAddressRequest $request, Wallet $wallet)
    {
        if ($wallet->status === Wallet::STATUS_DEACTIVATED) {
            return Response::forbidden('Wallet is currently deactivated, to activate go to dashboard',);
        }

        try {
            $data = (new WalletService())->getAddress($request, $wallet);
        } catch (WalletDontExistException $ex) {
            return Response::error($ex->getMessage());
        }

        return Response::success([
            'address' => $data,
            'expires' => now()->addHour(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Wallet\WalletUpdateRequest  $request
     * @param  App\Models\Wallet  $wallet
     * 
     * @return Illuminate\Http\JsonResponse
     */

    public function update(WalletUpdateRequest $request, Wallet $wallet)
    {
        $label = $request->filled('label') ? $request->label : $wallet->label;
        $status = $request->filled('status') ? $request->status : $wallet->status;

        $wallet->update([
            'label' => $label,
            'status' => $status
        ]);

        /*
        if($wallet->publicKey()->exists()) {
            $publicKey = $request->filled('public_key') ? $request->public_key : $wallet->public_key()->key;

            $wallet->publicKey()->update([
                'key' => $publicKey,
            ]);
        }*/

        return Response::successMessage('Wallet updated');
    }

    /**
     * Return wallet object
     *
     * @param  App\Models\Wallet $wallet
     * 
     * @return Illuminate\Http\JsonResponse
     */

    public function show(Wallet $wallet)
    {
        return Response::success(new WalletShowResource($wallet));
    }

    /**
     * Soft delete wallet from storage 
     * 
     * @param App\Models\Wallet $wallet
     * 
     * @return Illuminate\Http\JsonResponse
     */

    public function destroy(Wallet $wallet)
    {
        $wallet->delete();

        return Response::successMessage('Wallet deleted');
    }
}
