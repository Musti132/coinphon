<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'txid' => '469b59b9e98a22f10b3f67138856c6d0032f5bc57a7a8e623a2cc6fabbdc52c5',
            'received' => '0.00281823',
            'received_fiat' => '130.45',
            'confirmations' => 0,
            'from_address' => '1FdHZcXXLEJv7ThNvvdDCYjBEzZcRYLpL9',
            'order_id' => Order::all()->random(1)->first()->id,
        ];
    }
}
