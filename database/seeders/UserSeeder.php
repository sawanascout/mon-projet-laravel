<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'GLOBALDROP',
            'email' => 'globaldrop2428@gmail.com',//globaldrop2428@gmail.com
            'password' => Hash::make('DropGlobal8242'), 
            'role' => 'admin',
            'telephone' => '0664380887',
            'segment' => 'premium',
            'referral_code' => 'ADMIN1234',
            'parrain_id' => null,
            'email_verified_at' => now(),
        ]);
          
    }
}

