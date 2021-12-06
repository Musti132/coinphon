<?php

namespace App\Http\Controllers\Api\Overview;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Models\CryptoType;
use App\Models\CryptoRate;
use App\Models\Order;
use App\Models\User;
use App\Models\UserLogin;
use App\Repository\DashboardRepository;
use Illuminate\Http\Request;
use Chartisan\PHP\Chartisan;
use DB;

class SalesStatisticsController extends Controller
{
    public $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function index(Request $request)
    {
        $ordersYesterday = $this->dashboardRepository->getOrdersByDate(now()->subDay(1))
        ->select('created_at', DB::raw('count(created_at) as order_count'))
        ->groupBy('created_at')
        ->get();

        $ordersToday = $this->dashboardRepository->getOrdersByDate(today())
        ->select('created_at', DB::raw('count(created_at) as order_count'))
        ->groupBy('created_at')
        ->get();

        $ordersTodayCount = (empty($ordersToday->pluck('order_count'))) ? $ordersToday->pluck('order_count')[0] : 0;

        $ordersYesterdayCount = (empty($ordersYesterday->pluck('order_count'))) ? $ordersYesterday->pluck('order_count')[0] : 0;

        $changeVolume = $this->dashboardRepository->calculatePercentageChange(
            $ordersTodayCount,
            $ordersYesterdayCount
        );

        $rate = CryptoType::find(1)->rates()->where('currency', 'USD')->first()->rate ?? 33567.600;

        $cryptoBalance = "0.551223";

        $fiatBalance = number_format($cryptoBalance * $rate, 2);

        return Response::success([
            'today' => $ordersTodayCount,
            'yesterday' => $ordersYesterdayCount,
            'total_balance_fiat' => $fiatBalance,
            'sales_change' => $changeVolume,
            'order_volume' => Chartisan::build()
                ->labels(['total_volume'])
                ->extra(['change24h' => $changeVolume])
                ->dataset("today", [$ordersToday->pluck('created_at', 'order_count')])
                ->dataset("yesterday", [$ordersYesterday->pluck('created_at', 'order_count')])
                ->toObject(),
        ]);
    }
}
