<?php

namespace Database\Factories;

use App\Models\ApiLog;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApiLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApiLog::class;

    protected $requests = [
        'empty' => [],
        'params' => [
            'wallet_id' => 'testingwallet',
        ],
    ];

    protected $responses = [
        'success' => [
            'status' => 'success',
            'data' => [
                "id" => "87f4f472-502b-409c-a44d-14c2e6e35036",
                "label" => "B1TJXoHN517cSc4K",
                "balance" => "0.0000000",
                "type" => [
                    "short" => "BTC",
                    "name" => "Bitcoin"
                ],
                "created_at" => "8 minutes ago"
            ],
        ],
        'failed' => [
            'status' => 'failed',
            'message' => 'Check your input',
        ]
    ];
 
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $request = json_encode($this->requests[array_rand($this->requests)]);
        $response = json_encode($this->responses[array_rand($this->responses)]);

        return [
            'host' => '127.0.0.1',
            'request' => $request,
            'response' => $response,
        ];
    }
}
