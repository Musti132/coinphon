<?php

namespace App\Repository;

use App\Models\Order;
use App\Models\Wallet;
use Illuminate\Support\Carbon;
use Str;

class DashboardRepository
{


    /**
     * Return users orders for a specific date
     * 
     * @param Carbon $date
     * 
     * @return App\Models\Order;
     */
    public function getOrdersByDate(Carbon $date)
    {
        $query = Order::whereIn('wallet_id', auth()->user()->wallets()->pluck('id'))
            ->whereDate('created_at', $date);

        return $query;
    }


    /**
     * @param int $newNumber
     * @param int $oldNumber
     * 
     * @return int
     */
    function calculatePercentageChange(int $newNumber, int $oldNumber): int
    {
        if ($oldNumber == 0) {
            $oldNumber++;
            $newNumber++;
        }

        $change = (($newNumber - $oldNumber) / $oldNumber) * 100;

        return (int) number_format($change, 2);
    }
}
