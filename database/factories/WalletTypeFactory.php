<?php

namespace Database\Factories;

use App\Models\CryptoType;
use App\Models\CryptoWallet;
use App\Models\Wallet;
use App\Models\WalletType;
use Illuminate\Database\Eloquent\Factories\Factory;

class WalletTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CryptoWallet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'wallet_id' => Wallet::all()->random()->id,
            'crypto_id' => CryptoType::all()->random()->id,
        ];
    }
}
