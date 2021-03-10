<?php

namespace App\Repository;

use App\Models\Order;

class OrderRepository
{
    

    /**
     * @param int $id
     * 
     * @return Order
     */
    public function getOrder(int $id)
    {
        return Order::findOrFail($id);
    }

    /**
     * @param int $id
     * 
     * @return Wallet
     */
    public function getAllOrdersById(int $id)
    {
        return auth()->user()->orders();
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
        return $this->sort(new Order, $orderBy, $sort, $columns);
    }

    /**
     * Returns all wallets related to the authenticated user.
     *
     * @param bool $withTransaction Load transaction
     * 
     * @return Wallet.
     */
    public function allByAuthUser(bool $withTransaction = false)
    {
        $wallets = $this->getAllOrdersById(\Auth::id())
        ->when($withTransaction, function($q) use($withTransaction){
            $q->with(['transaction', 'wallet' => function($q){
                $q->with('type');
            }]);
        })->get();

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
}
