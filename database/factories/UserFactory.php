<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\PhoneNumber;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'first' => $this->faker->name,
            'last' => $this->faker->name,
            'country_id' => Country::all()->random(1)->first()->id,
            'email' => "power132@mail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'settings' => json_encode([
                '2fa_enabled' => false,
            ]),
            'remember_token' => Str::random(10),
        ];
    }
}
