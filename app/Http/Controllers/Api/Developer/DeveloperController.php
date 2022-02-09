<?php

namespace App\Http\Controllers\Api\Developer;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Models\MonitoringIn;
use App\Models\MonitoringOut;
use App\Models\Wallet;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use DB;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userWalletIds = auth()->user()->wallets()->pluck('id');

        //dd(Carbon::createFromTimestamp($request->date)->subHours(4)->toDateTimeString());
        $failedIn = MonitoringIn::failedCount($userWalletIds)
        ->when($request->date, function($q) use ($request) {
            $q->whereBetween('created_at', [Carbon::createFromTimestamp($request->date)->toDateTimeString(), Carbon::now()->toDateTimeString()]);
        })
        ->select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count'),
        ])
        ->groupBy('date')
        ->get();

        $successIn = MonitoringIn::successCount($userWalletIds)
        ->when($request->date, function($q) use ($request) {
            $q->whereBetween('created_at', [Carbon::createFromTimestamp($request->date)->toDateTimeString(), Carbon::now()->toDateTimeString()]);
        })
        ->select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count'),
        ])
        ->groupBy('date')
        ->get();

        $failedOut = MonitoringOut::failedCount($userWalletIds)
        ->when($request->date, function($q) use ($request) {
            $q->whereBetween('created_at', [Carbon::createFromTimestamp($request->date)->toDateTimeString(), Carbon::now()->toDateTimeString()]);
        })
        ->select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count'),
        ])
        ->groupBy('date')
        ->get();

        $successOut = MonitoringOut::successCount($userWalletIds)
        ->when($request->date, function($q) use ($request) {
            $q->whereBetween('created_at', [Carbon::createFromTimestamp($request->date)->toDateTimeString(), Carbon::now()->toDateTimeString()]);
        })
        ->select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count'),
        ])
        ->groupBy('date')
        ->get();
        

        return Response::success([
            'in' => [
                'success' => Chartisan::build()
                ->labels($successIn->pluck('date')->toArray())
                ->extra(['success_dataset' => $successIn->sum('count')])
                    ->dataset("success_dataset", [$successIn->pluck('count', 'date')])
                    ->toObject(),
                'failed' => Chartisan::build()
                ->labels($failedIn->pluck('date')->toArray())
                ->extra(['failed_dataset' => $failedIn->sum('count')])
                    ->dataset("failed_dataset", [$failedIn->pluck('count', 'date')])
                    ->toObject(),
                
            ],
            'out' => [
                'success' => Chartisan::build()
                ->labels($successOut->pluck('date')->toArray())
                ->extra(['total_count' => $successOut->sum('count')])
                    ->dataset("success_dataset", [$successOut->pluck('count', 'date')])
                    ->toObject(),
                'failed' => Chartisan::build()
                ->labels($failedOut->pluck('date')->toArray())
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
