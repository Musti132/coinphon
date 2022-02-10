<?php

namespace App\Http\Controllers\Api\Wallet\Manage;

use App\Helpers\Miscellaneous;
use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\Manage\StatisticsRequest;
use App\Http\Resources\Wallet\Manage\StatisticsResource;
use App\Models\Order;
use App\Models\Wallet;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use DB;
use Illuminate\Http\Request;

class ManageController extends Controller
{
    public function statistics(StatisticsRequest $request, Wallet $wallet)
    {
        $startDate = ($request->filled('date_start')) ? Carbon::createFromTimestamp($request->date_start) : Carbon::createFromFormat('Y-m-d', today()->toDateString())->endOfDay();
        $endDate = ($request->filled('date_end')) ? Carbon::createFromTimestamp($request->date_end) : today()->subDay();

        $dataSet = $wallet
            ->orders()
            ->select(
                DB::raw('DATE(created_at) as date'),
                'amount',
                DB::raw('SUM(amount_fiat) as total')
            )
            ->whereBetween('created_at', [$endDate, $startDate])
            ->groupBy('amount', 'created_at')
            ->orderBy('date', 'ASC')
            ->get();

        $statsFromDate = $wallet->revenueByDate($startDate);
        $statsToDate = $wallet->revenueByDate($endDate);

        $revenueFromDate = $statsFromDate->sum('amount_fiat');
        $revenueToDate = $statsToDate->sum('amount_fiat');

        $change = (new Miscellaneous)->calculatePercentageChange($revenueFromDate, $revenueToDate);

        return Response::success([
            'revenue_today' => number_format($statsFromDate->sum('amount'), 8),
            'revenue_today_fiat' => number_format($revenueFromDate, 2),
            'total_yesterday_fiat' => number_format($revenueToDate, 2),
            'total_yesterday' => number_format($statsToDate->sum('amount'), 8),
            'balance_change' => $change,
            'revenue' => Chartisan::build()
                ->labels(['revenue_change'])
                ->dataset("revenue", $dataSet->pluck('total', 'date')->toArray())
                ->toObject(),
        ]);
    }

    public function transactionFee()
    {
        // Calculate network transaction fee...
        return Response::success([
            'fee' => '0.00002',
        ]);
    }
}
