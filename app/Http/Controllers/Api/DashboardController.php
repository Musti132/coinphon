<?php

namespace App\Http\Controllers\Api;

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

class DashboardController extends Controller
{
    public $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository){
        $this->dashboardRepository = $dashboardRepository;
    }

    public function index(Request $request)
    {
        $ordersYesterday = $this->dashboardRepository->getOrdersByDate(now()->subDay(1))->get();
        $ordersToday = $this->dashboardRepository->getOrdersByDate(today())->get();

        $changeAmount = $this->dashboardRepository->calculatePercentageChange(
            $ordersToday->sum('amount_fiat'),
            $ordersYesterday->sum('amount_fiat')
        );

        $amountYesterday = $ordersYesterday->sum('amount_fiat');
        $amountToday = $ordersToday->sum('amount_fiat');

        $changeVolume = $this->dashboardRepository->calculatePercentageChange(
            $ordersToday->count(),
            $ordersYesterday->count()
        );

        $rate = CryptoType::find(1)->rates()->where('currency', 'USD')->first()->rate ?? 33567.600;

        $cryptoBalance = "0.551223";

        $fiatBalance = number_format($cryptoBalance * $rate, 2);

        return Response::success([
            'total_balance' => $cryptoBalance,
            'total_balance_fiat' => $fiatBalance,
            'balance_change' => $changeAmount,
            'volume_change' => $changeVolume,
            'revenue' => Chartisan::build()
                ->labels(['total_revenue'])
                ->extra(['change24h' => $changeAmount])
                    ->dataset("today", [$amountToday])
                    ->dataset("yesterday", [$amountYesterday])
                    ->toObject(),
            'order_volume' => Chartisan::build()
                ->labels(['total_volume'])
                ->extra(['change24h' => $changeVolume])
                    ->dataset("today", [$ordersToday->count()])
                    ->dataset("yesterday", [$ordersYesterday->count()])
                    ->toObject(),
            'price_chart' => [
                'coins' => [
                    [
                        'name' => 'Bitcoin',
                        'short' => 'BTC',
                        'price' => '49123.3',
                        'twenty_four_hour' => '29.3',
                        'cap' => '1,078,414,735,960',
                        'last_7' => Chartisan::build()
                            ->labels(['price_change'])
                                ->dataset("7days", [49123, 51299, 41382])
                                ->toObject(),
                    ],
                    [
                        'name' => 'Ethereum',
                        'short' => 'ETH',
                        'price' => '1599.3',
                        'twenty_four_hour' => '6.2',
                        'cap' => '206,515,284,213',
                        'last_7' => Chartisan::build()
                            ->labels(['price_change'])
                                ->dataset("7days", [1452, 1499, 1532])
                                ->toObject(),
                    ],
                ]
            ]
        ]);
    }
    
}
