<?php

namespace App\Http\Controllers\Api\Developer;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Models\MonitoringIn;
use App\Models\MonitoringOut;
use App\Models\Wallet;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use DB;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $userWalletIds = auth()->user()->wallets()->pluck('id');

        $failedIn = MonitoringIn::failedCount($userWalletIds)->select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count'),
        ])->groupBy('date')->get();

        $successIn = MonitoringIn::successCount($userWalletIds)->select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count'),
        ])->groupBy('date')->get();

        $failedOut = MonitoringOut::failedCount($userWalletIds)->select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count'),
        ])->groupBy('date')->get();

        $successOut = MonitoringOut::successCount($userWalletIds)->select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count'),
        ])->groupBy('date')->get();

        return Response::success([
            'in' => [
                'success' => Chartisan::build()
                ->labels([$successIn->pluck('date')])
                ->extra(['success_dataset' => $successIn->sum('count')])
                    ->dataset("today", [$successIn->pluck('count', 'date')])
                    ->toObject(),
                'failed' => Chartisan::build()
                ->labels([$failedIn->pluck('date')])
                ->extra(['failed_dataset' => $failedIn->sum('count')])
                    ->dataset("today", [$failedIn->pluck('count', 'date')])
                    ->toObject(),
                
            ],
            'out' => [
                'success' => Chartisan::build()
                ->labels([$successOut->pluck('date')])
                ->extra(['total_count' => $successOut->sum('count')])
                    ->dataset("success_dataset", [$successOut->pluck('count', 'date')])
                    ->toObject(),
                'failed' => Chartisan::build()
                ->labels([$failedOut->pluck('date')])
                ->extra(['total_count' => $failedOut->sum('count')])
                    ->dataset("failed_dataset", [$failedOut->pluck('count', 'date')])
                    ->toObject(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
