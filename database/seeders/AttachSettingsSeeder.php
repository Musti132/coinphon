<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AttachSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach($users as $user){
            $user->settings()->apply([
                '2fa_enabled' => true,
            ]);
        }

    }
}
