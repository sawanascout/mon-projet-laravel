<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::query()->delete();

        User::create([
            'name' => 'Alice',
            'email' => 'alice@example.com',
            'password' => bcrypt('password'),
            'segment' => 'habit femme',
        ]);

        User::create([
            'name' => 'Bob',
            'email' => 'bob@example.com',
            'password' => bcrypt('password'),
            'segment' => 'habit homme',
        ]);
    }
}
