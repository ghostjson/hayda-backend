<?php

namespace Database\Seeders;

use http\Client\Curl\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\Models\User();
        $user->email = 'admin@hayda.com';
        $user->password = '17291234';
        $user->name = 'admin';
        $user->role = 'admin';
        $user->save();
    }
}
