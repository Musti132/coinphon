<?php

namespace Database\Factories;

use App\Models\ApiKey;
use App\Models\ApiLog;
use App\Models\Wallet;

use App\Models\MonitoringOut;
use Illuminate\Database\Eloquent\Factories\Factory;

class MonitoringOutFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MonitoringOut::class;

    protected $codes = [
        '200',
        '400',
        '502',
    ];

    protected $paths = [
        '/api/v1/address/generate',
        '/api/v1/order',
        '/api/v1/wallet/',
    ];

    protected $types = [
        'POST',
        'GET',
        'DELETE',
        'PUT',
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $code = $this->codes[array_rand($this->codes)];
        $path = $this->paths[array_rand($this->paths)];
        $type = $this->types[array_rand($this->types)];

        return [
            'api_key' => ApiKey::all()->random(1)->first()->id,
            'code' => $code,
            'type' => $type,
            'path' => $path,
            'wallet_id' => Wallet::all()->random(1)->first()->id,
            'log_id' => ApiLog::all()->random(1)->first()->id,
            'created_at' => now()->subDay(mt_rand(0, 7)),
        ];
    }
}
