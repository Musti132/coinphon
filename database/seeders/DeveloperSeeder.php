<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ApiKey::factory(1)->create();
        \App\Models\ApiLog::factory(20)->create();
        \App\Models\MonitoringIn::factory(20)->create();
        \App\Models\MonitoringOut::factory(20)->create();
    }
}
