<?php

namespace App\Repository;

use App\Models\CryptoType;
use App\Models\Wallet;
use App\Models\WalletPublicKey;
use Request;
use Str;

class WalletRepository
{
    
    /**
     * @param int $id
     * 
     * @return Wallet
     */
    public function getWallet(string $id)
    {
        return Wallet::findOrFail($id);
    }

    /**
     * @param string $id
     * 
     * @return Wallet
     */
    public function getAllWalletById(string $id)
    {
        return User::findOrFail($id)->wallets();
    }

    /**
     * @param string $orderBy
     * @param string $sort
     * @param array $columns
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all(string $orderBy = "id", string $sort = "asc", array $columns = [])
    {
        return $this->sort(new Wallet, $orderBy, $sort, $columns);
    }

    /**
     * Returns all wallets related to the currently logged in user.
     *
     * @return App\Model\Wallet.
     */
    public function allByAuthUser($sort = 'asc', $column = 'created_at')
    {
        $wallets = auth()->user()->wallets()->with('publicKey');
        
        return $this->sort($wallets, $column, $sort);
    }
    
    /**
     * Sort query
     *
     * @param  Model $q
     * @param  String $orderBy
     * @param  String $sort
     * @param  Array $columns
     * @return Collection
     */
    public function sort($q, string $orderBy = null, string $sort = "asc", array $columns = [])
    {
        return $q->when($orderBy, function ($q) use ($orderBy, $sort) {
            return $q->orderBy($orderBy, $sort);
        })->when($columns, function ($q) use ($columns) {
            return $q->select($columns);
        });
    }

    public function createWallet(string $label, string $fullLabel, $serverId, $request){
        $publicKey = null;
        $walletType = 1;

        if($request->wallet_type == "external") {
            $publicKey = Str::random(124);
            $walletType = 2;
        }

        $cryptoType = CryptoType::find($request->crypto_type);

        $wallet = Wallet::create([
            'label' => $label,
            'user_id' => auth()->id(),
            'uuid' => (string) Str::uuid(),
            'type_id' => $walletType,
            'status' => 1,
            'full_label' => $fullLabel,
            'server_id' => $serverId,
        ]);

        //$wallet = Wallet::find($wallet->id);

        $wallet->cryptos()->attach([
            $cryptoType->id,
        ]);

        if($request->wallet_type == "external") {
            $publicKey = new WalletPublicKey([
                'key' => $publicKey,
            ]);

            $wallet->publicKey()->save($publicKey);
        }

        return $wallet;

    }
}
