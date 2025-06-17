<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Pour Femmes',
            'Mode & Accessoires',
            'Pour Hommes',
            // ajoute d’autres catégories ici si besoin
        ];

        foreach ($categories as $name) {
            Category::updateOrCreate(
                ['category_name' => $name],
                ['slug' => Str::slug($name)]
            );
        }
    }
}
