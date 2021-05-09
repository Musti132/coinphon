<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\PhoneNumber;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneNumberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PhoneNumber::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $number = $this->faker->phoneNumber;
        $number = str_replace([
            '(',
            ')',
            ' ',
            '+',
            '.'
        ], '', $number);

        return [
            'number' => $number,
            'country_id' => Country::all()->random(1)->first()->id,
            'user_id' => User::all()->first()->id,
        ];
    }
}
