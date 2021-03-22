<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Wallet;

class GetWalletBalanceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetWalletBalance()
    {
        $expectedBalance = "0.0000000";
        
        $walletBalance = Wallet::find(2)->getWallet()->getBalance();

        $this->assertEquals(
            $walletBalance,
            $expectedBalance,
            'Couldn\'t get wallet balance',
        );

    }
}
