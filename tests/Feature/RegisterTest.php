<?php

namespace Tests\Feature;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register()
    {

        $userData = [
            'email' => $this->faker->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'country' => Country::all()->random(1)->first()->id,
            'first' => $this->faker->firstName(),
            'last' => $this->faker->lastName(),
        ];

        $response = $this->postJson('api/v1/auth/register', $userData, [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534.27 (KHTML, like Gecko) Chrome/12.0.712.0 Safari/534.27',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
            ])
            ->assertCookie('token')
            ->assertCookie('logged_in')
            ->assertCookie('csrf_tkn');
    }

    public function test_register_business() {

    }
}
