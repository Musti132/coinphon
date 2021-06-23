<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use RandomLib\Factory as RandomFactory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $factory = new RandomFactory;

        $generator = $factory->getMediumStrengthGenerator();

        $orderId = 'PHON'.$generator->generateString(7, '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');

        $rand = mt_rand(1, 2);

        $status = mt_rand(0, 4);

        $date = now();

        if($rand == 1){
            $date = now()->subDay(1);
        }

        return [
            'order_id' => $orderId,
            'wallet_id' => Wallet::all()->random(1)->first()->id,
            'amount' => '0.00281823',
            'amount_fiat' => mt_rand(000, 999).'.45',
            'address' => '18q5XMhURn2eJfFD3drNGanky9DAou4yvL',
            'status' => $status,
            'expires_at' => now()->addDays(10),
            'created_at' => $date
        ];
    }
}
