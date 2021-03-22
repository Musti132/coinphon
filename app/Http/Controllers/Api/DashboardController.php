<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;

class DashboardController extends Controller
{
    public function index(){

        return Response::success([
            'total_balance' => '0.0551223',
            'total_balance_fiat' => '700',
            'revenue' => Chartisan::build()
            ->labels(['total_revenue'])
            ->dataset("24h", [52, 41, 991])
            ->toObject(),
            'order_volume' => Chartisan::build()
            ->labels(['total_volume'])
            ->dataset("24h", [52, 41, 991])
            ->toObject(),
            'price_chart' => [
                'coins' => [
                    [
                        'name' => 'Bitcoin',
                        'short' => 'BTC',
                        'price' => '49123.3',
                        '24h' => '29.3',
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
                        '24h' => '6.2',
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
