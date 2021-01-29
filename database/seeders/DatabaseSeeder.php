<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ServerRegion::factory(1)->create();
        \App\Models\Server::factory(1)->create();
        \App\Models\User::factory(1)->create();
    }
}
