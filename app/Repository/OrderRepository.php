<?php

namespace App\Repository;

use App\Helpers\Response;
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
    public function getAllOrdersById(string $id)
    {
        $orders = auth()->user()->orders();

        return $orders;
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
     * @param bool $withType Load wallet types
     * 
     * @return Wallet.
     */
    public function allByAuthUser(bool $withTransaction = false, bool $withType = false, $sort = 'asc', $column = "created_at")
    {
        $orders = $this->getAllOrdersById(\Auth::id())
        ->when($withTransaction, function($q) use($withTransaction){
            return $q->with(['transaction']);
        })->when($withType, function ($q) use($withType){
            return $q->with(['wallet' => function($q){
                return $q->with('type');
            }]);
        });

        return $this->sort($orders, $column, $sort);
    }
    
    /**
     * Sort query
     *
     * @param  Model $q
     * @param  string $orderBy
     * @param  string $sort
     * @param  array $columns
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
}
