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
        $userData = $this->fakeUser();

        $response = $this->postJson('api/v1/auth/login', [
            'email' => $userData->email,
            'password' => 'password',
        ], [
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
}
