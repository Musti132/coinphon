<?php

namespace App\Http\Controllers\Api\Wallet\Manage;

use App\Helpers\Miscellaneous;
use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\Wallet\Manage\StatisticsResource;
use App\Models\Wallet;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;

class ManageController extends Controller
{
    public function statistics(Request $request, Wallet $wallet)
    {
        $statsToday = $wallet->revenueByDate(today());
        $statsYesterday = $wallet->revenueByDate(now()->subDay(1))->get();

        $revenueToday = $statsToday->sum('amount_fiat');
        $revenueYesterday = $statsYesterday->sum('amount_fiat');

        $change = (new Miscellaneous)->calculatePercentageChange($revenueToday, $revenueYesterday);

        return Response::success([
            'revenue_today' => number_format($statsToday->sum('amount'), 8),
            'revenue_today_fiat' => number_format($revenueToday, 2),
            'balance_change' => $change,
            'revenue' => Chartisan::build()
                ->labels(['revenue_change'])
                ->extra([
                    'change24h' => $change,
                    'total_yesterday_fiat' => number_format($revenueYesterday, 2),
                    'total_yesterday' => number_format($statsYesterday->sum('amount'), 8),
                ])
                ->dataset("today", [$statsToday->pluck('amount_fiat', 'created_at')])
                ->dataset("yesterday", [$statsYesterday->pluck('amount_fiat', 'created_at')])
                ->toObject(),
        ]);
    }
}
