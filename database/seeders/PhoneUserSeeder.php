<?php

namespace Database\Seeders;

use App\Models\PhoneNumber;
use App\Models\User;
use Illuminate\Database\Seeder;

class PhoneUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phoneNumber = \App\Models\PhoneNumber::factory(1)->create()->first();

        $user = User::first()->phone()->save($phoneNumber);
    }
}
