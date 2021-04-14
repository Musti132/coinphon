<?php

namespace App\Repository;

use App\Models\Wallet;
use Illuminate\Support\Carbon;
use Str;

class DashboardRepository
{
    public function getOrdersByDate(Carbon $date){
        return auth()->user()->orders()->whereDate('orders.created_at', $date);
    }

    function calculatePercentageChange($newNumber, $oldNumber) : int
    {
        if ($oldNumber == 0) {
            $oldNumber++;
            $newNumber++;
        }

        $change = (($newNumber - $oldNumber) / $oldNumber) * 100;

        return (int) number_format($change, 2);
    }
}
