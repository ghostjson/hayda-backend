<?php

namespace Database\Seeders;

use App\Models\Weight;
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
        $user->subscription = 1;
        $user->save();

        // create a weight field for the created user
        Weight::create([
            'user_id' => $user->id,
            'goal_weight' => $user->weight - 20,
            'data' => json_encode([])
        ]);
    }
}
