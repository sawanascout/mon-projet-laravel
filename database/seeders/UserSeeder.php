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
            'name' => 'KOLANI ',
            'email' => 'annagreterk@gmail.com',
            'password' => Hash::make('123456789'), // 🔒 Toujours hasher !
            'role' => 'admin',
            'telephone' => '0123456789',
            'segment' => 'premium',
            'referral_code' => 'ADMIN1234',
            'parrain_id' => null,
            'email_verified_at' => now(),
        ]);
          User::create([
            'name' => 'Client Exemple',
            'email' => 'client@globaldrop.com',
            'password' => Hash::make('password'), // mot de passe : password
            'role' => 'client',
            'telephone' => '0987654321',
            'segment' => 'standard',
            'referral_code' => 'CLIENT1234',
            'parrain_id' => null,
            'email_verified_at' => now(),
        ]);
    }
}

