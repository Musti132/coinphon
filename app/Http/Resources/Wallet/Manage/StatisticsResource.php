<?php

namespace App\Http\Resources\Wallet\Manage;

use Illuminate\Http\Resources\Json\JsonResource;

class StatisticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $statsToday = $this->revenueByDate(today())->get();
        $statsYesterday = $this->revenueByDate(now()->subDay(1))->get();

        return [
            'amount_fiat' => number_format($this->sum('amount_fiat'), 2),
            'amount' => number_format($this->sum('amount'), 8),
        ];
    }
}
