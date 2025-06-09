<?php

namespace Database\Seeders;
use App\Models\Produits;
use App\Models\Categories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker; 

class ProduitsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        // On récupère les IDs des catégories existantes
        $categoriesIds = DB::table('categories')->pluck('id')->toArray();
        
        if (empty($categoriesIds)) {
            $this->command->error("Il faut d'abord remplir la table categories !");
            return;
        }
        for ($i = 1; $i <= 30; $i++) {
            $prix = $faker->randomFloat(2, 5, 200);
            $ancienPrix = $faker->boolean(50) ? $prix + $faker->randomFloat(2, 5, 50) : null;

            Produits::create([
                'nom' => $faker->words(3, true),
                'prix' => $prix,
                'ancien_prix' => $ancienPrix,
                'description' => $faker->paragraph(),
                'categories_id' => $faker->randomElement($categoriesIds),
                'photo' => 'produits/produit' . $i . '.jpg', // Assure-toi d'avoir ces images ou adapte
                'disponible' => $faker->boolean(90),
            ]);
        }

        $this->command->info('30 produits insérés avec succès.');

    }
}
