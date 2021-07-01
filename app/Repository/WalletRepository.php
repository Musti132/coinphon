<?php

namespace App\Repository;

use App\Models\Wallet;
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
     * @return Wallet.
     */
    public function allByAuthUser()
    {
        $wallets = auth()->user()->wallets()->with('publicKey');
        
        return $wallets;
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
        })->get();
    }

    public function createWallet(string $label, string $fullLabel, $serverId){
        return new Wallet([
            'label' => $label,
            'uuid' => (string) Str::uuid(),
            'type_id' => 1,
            'status' => 1,
            'full_label' => $fullLabel,
            'server_id' => $serverId,
        ]);
    }
}
