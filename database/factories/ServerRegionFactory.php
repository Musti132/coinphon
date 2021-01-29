<?php

namespace Database\Factories;

use App\Models\ServerRegion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServerRegionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServerRegion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'region' => 'eu',
        ];
    }
}
