<?php

namespace Database\Factories;

use App\Models\CryptoType;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Server;
use App\Models\User;
use App\Models\WalletType;
use Illuminate\Support\Facades\Log;

class WalletFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wallet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = WalletType::all()->random();

        $data = [
            'user_id' => User::all()->random(1)->first()->id,
            'label' => Str::random(16),
            'uuid' => (string) Str::uuid(),
            'type_id' => $type->id,
            'full_label' => $this->faker->username,
            'server_id' => Server::all()->random(1)->first()->id,
        ];

        return $data;
    }
}
