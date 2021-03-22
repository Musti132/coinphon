<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $userData = User::all()->first();

        $response = $this->postJson('api/v1/auth/login', [
            'email' => $userData->email,
            'password' => 'password',
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
}
