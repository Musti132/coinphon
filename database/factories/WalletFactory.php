<?php

namespace Database\Factories;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Server;

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
        return [
            'user_id' => 1,
            'label' => Str::random(16),
            'uuid' => (string) Str::uuid(),
            'type_id' => 1,
            'full_label' => $this->faker->username,
            'server_id' => Server::all()->random(1)->first()->id,
        ];
    }
}