<?php

namespace App\Http\Resources\Wallet;

use Illuminate\Http\Resources\Json\JsonResource;
use Cache;

class WalletShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $wallet = $this->getWallet();

        $balance = Cache::remember('wallet_'.$this->uuid, now()->addSeconds(config('cache.wallet_balance_ttl')), function () use($wallet) {
            return $wallet->getBalance();
        });

        return [
            'id' => $this->uuid,
            'label' => $this->label,
            'status' => $this->status,
            'balance' => $balance,
            'balance_fiat' => 0,
            'balance_change_24h' => '0',
            'wallet_type' => $this->type->short,
            'crypto_type' => CryptoTypeResource::collection($this->whenLoaded('cryptos')),
            'public_key' => optional($this->publicKey)->key,
            'created' => $this->created_at->diffForHumans(),
        ];
    }
}
