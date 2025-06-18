<?php

namespace Database\Seeders;

use App\Models\Produits;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;

class ProduitsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // IDs des catégories
        $categoriesIds = DB::table('categories')->pluck('id')->toArray();

        if (empty($categoriesIds)) {
            $this->command->error("Il faut d'abord remplir la table categories !");
            return;
        }

        // Listes possibles de couleurs et tailles
        $couleursPossibles = ['rouge', 'bleu', 'vert', 'noir', 'blanc', 'jaune', 'violet', 'orange'];
        $taillesPossibles = ['S', 'M', 'L', 'XL', 'XXL'];

        for ($i = 1; $i <= 30; $i++) {
            $prix = $faker->randomFloat(2, 5, 200);
            $ancienPrix = $faker->boolean(50) ? $prix + $faker->randomFloat(2, 5, 50) : null;

            // Choisir aléatoirement 2 à 4 couleurs et tailles pour chaque produit
 

            Produits::create([
                'nom' => $faker->words(3, true),
                'prix' => $prix,
                'ancien_prix' => $ancienPrix,
                'description' => $faker->paragraph(),
                'categories_id' => $faker->randomElement($categoriesIds),
                'photo' => 'produits/produit' . $i . '.jpg', // adapte si besoin
                'disponible' => $faker->boolean(90),
            
            ]);
        }

        $this->command->info('30 produits insérés avec couleurs et tailles.');
    }
}
