<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ListWalletsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListWallets()
    {
        $user = User::all()->first();

        $auth = JWTAuth::fromUser($user, true);
        
        $response = $this->call('GET', 'api/v1/wallet', [], [
            'token' => $auth,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
            ])
            ->assertJsonStructure([
                'status', 'data' => []
            ]);
    }
}
