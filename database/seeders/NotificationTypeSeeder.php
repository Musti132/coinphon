<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'Crypto'],
            ['name' => 'Payment'],
            ['name' => 'News'],
        ];

        DB::table('notification_types')->insert($types);
    }
}
