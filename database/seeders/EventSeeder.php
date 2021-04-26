<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class EventSeeder extends Seeder
{

    protected $events = [
        ['event' => 'confirmations'],
        ['event' => 'new'],
        ['event' => 'updated'],
        ['event' => 'confirmed'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert($this->events);
    }
}
