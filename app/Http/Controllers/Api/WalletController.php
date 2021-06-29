<?php

namespace App\Http\Controllers\Api;

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

class WalletController extends Controller
{
    public $walletRepository;

    public function __construct(WalletRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    /**
     * index
     * 
     * @return Illuminate\Http\JsonResponse
     */

    public function index()
    {
        $wallets = $this->walletRepository->allByAuthUser();

        return WalletListResource::collection($wallets->paginate(Pagination::DEFAULT_PER_PAGE))->additional([
            'status' => 'success',
        ]);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return Illuminate\Http\JsonResponse
     */

    public function store(WalletCreate $request)
    {
        $user = $request->user();
        $server = Server::find(1);
        $label = $request->label;

        try {
            $wallet = $user->createWallet($server, $label);

            $walletObject = $this->walletRepository->createWallet($label, $wallet->name, $server->id);

            $user->wallets()->save($walletObject);

            return Response::success(new WalletShowResource($walletObject), 'Your wallet will be created shortly');
        } catch (WalletCreatorException $ex) {
            return Response::error('Unknown error happened, please contact support. ' . $ex->getMessage());
        }
    }

    /**
     * balance
     *
     * @param  mixed $wallet
     * @return void
     */

    public function balance(Wallet $wallet)
    {
        try {
            $balance = $wallet->refreshBalance();
            Cache::put('wallet_' . $wallet->uuid, $balance, now()->addSeconds(config('cache.wallet_balance_ttl')));
        } catch (Exception $ex) {
            return Response::error('Couldnt refresh balance');
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
     * @return \Illuminate\Http\Response
     */

    public function update(WalletUpdateRequest $request, Wallet $wallet)
    {
        $label = $request->filled('label') ? $request->label : $wallet->label;
        $status = $request->filled('status') ? $request->status : $wallet->status;

        $wallet->update([
            'label' => $label,
            'status' => $status
        ]);

        return Response::successMessage('Wallet updated');
    }

    /**
     * show
     *
     * @param  mixed $wallet
     * @return Illuminate\Http\JsonResponse
     */

    public function show(Wallet $wallet)
    {
        return Response::success(new WalletShowResource($wallet));
    }

    /**
     * destroy
     * 
     * @param Wallet $wallet
     * @return Illuminate\Http\JsonResponse
     */

    public function destroy(Wallet $wallet)
    {
        $wallet->delete();

        return Response::successMessage('Wallet deleted');
    }
}
