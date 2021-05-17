<?php

namespace App\Repository;

use App\Models\Wallet;
use Illuminate\Support\Carbon;
use Str;

class DashboardRepository
{


    /**
     * @param Carbon $date
     * 
     * @return App\Models\Order;
     */
    public function getOrdersByDate(Carbon $date){
        return auth()->user()->orders()->whereDate('orders.created_at', $date);
    }


    /**
     * @param int $newNumber
     * @param int $oldNumber
     * 
     * @return int
     */
    function calculatePercentageChange(int $newNumber, int $oldNumber) : int
    {
        if ($oldNumber == 0) {
            $oldNumber++;
            $newNumber++;
        }

        $change = (($newNumber - $oldNumber) / $oldNumber) * 100;

        return (int) number_format($change, 2);
    }
}
