<?php

namespace Database\Factories;

use App\Models\Webhook;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebhookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Webhook::class;

    protected $endpoints = [
        'https://google.com',
        'https://facebook.com',
        'https://yahoo.com'
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $endpoint = $this->endpoints[array_rand($this->endpoints)];

        return [
            'name' => 'My Key '.mt_rand(0, 10),
            'endpoint' => $endpoint,
            'wallet_id' => Wallet::all()->random(1)->first()->id,
        ];
    }
}
