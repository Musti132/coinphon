<?php

namespace App\Repository;

use App\Models\Wallet;

class WalletRepository
{
    

    /**
     * @param int $id
     * 
     * @return Wallet
     */
    public function getWallet(int $id)
    {
        return Wallet::findOrFail($id);
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
     * Returns all wallets related to the authenticated user.
     *
     * @return Wallet.
     */
    public function allByAuthUser()
    {
        return auth()->user()->wallets;
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
}