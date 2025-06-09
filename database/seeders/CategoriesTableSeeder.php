<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['nom' => 'Mobilier', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Électronique', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Vêtements', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Cuisine', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Jardinage', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Sports', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Beauté', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Livres', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Jouets', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Informatique', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('categories')->insert($categories);
    }
}
