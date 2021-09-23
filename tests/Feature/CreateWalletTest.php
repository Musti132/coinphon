<?php

namespace Tests\Feature;

use App\Models\CryptoType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Str;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CreateWalletTest extends TestCase
{
    public $wallets = 2;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {   
        for($i = 0; $i < $this->wallets; $i++){
            $user = $this->fakeUser();

            $auth = JWTAuth::fromUser($user, true);
    
            $response = $this->call('POST', 'api/v1/wallet/', [
                'label' => 'HelloWallet'.Str::random(2),
                'crypto_type' => CryptoType::all()->random(1)->first()->id,
                'wallet_type' => 'online'
            ], [
                'token' => $auth,
            ]);
    
            $response
                ->assertStatus(200);
        }
    }
}
