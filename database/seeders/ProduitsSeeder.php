<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produits;
use App\Models\Category;

class ProduitsSeeder extends Seeder
{
    public function run()
    {
        Produits::query()->delete();

        // Récupération des catégories
        $pourFemmes = Category::where('category_name', 'Pour Femmes')->first();
        $pourHommes = Category::where('category_name', 'Pour Hommes')->first();
        $modeAccessoires = Category::where('category_name', 'Mode & Accessoires')->first();

        // Vérifie que les catégories existent
        if (!$pourFemmes || !$pourHommes || !$modeAccessoires) {
            $this->command->error('Une ou plusieurs catégories sont manquantes. Lancez d\'abord CategorySeeder.');
            return;
        }

        $products = [
            [
                'nom' => 'Chaussure Femme',
                'description' => 'Chaussures élégantes pour toutes les occasions.',
                'prix' => 12000,
                'ancien_prix' => 15000,
                'photo' => 'products/chaussure.jpg',
                'category_id' => $pourFemmes->id,
            ],
            [
                'nom' => 'Montre',
                'description' => 'Montre élégante et résistante à l\'eau.',
                'prix' => 18000,
                'ancien_prix' => 20000,
                'photo' => 'products/montre.jpg',
                'category_id' => $modeAccessoires->id,
            ],
            [
                'nom' => 'Sac à dos',
                'description' => 'Un sac stylé pour vos sorties.',
                'prix' => 9500,
                'ancien_prix' => 10000,
                'photo' => 'products/sac.jpg',
                'category_id' => $modeAccessoires->id,
            ],
            [
                'nom' => 'Casque',
                'description' => 'Stylé.',
                'prix' => 1000,
                'ancien_prix' => 1500,
                'photo' => 'products/casque.jpg',
                'category_id' => $modeAccessoires->id,
            ],
            [
                'nom' => 'Chaussures de tennis',
                'description' => 'Mocassins décontractés en cuir pour hommes',
                'prix' => 9000,
                'ancien_prix' => 12000,
                'photo' => 'products/Chaussure Homme.jpg',
                'category_id' => $pourHommes->id,
            ],
            [
                'nom' => 'Robe longue',
                'description' => 'Élégant.',
                'prix' => 10500,
                'ancien_prix' => 11500,
                'photo' => 'products/Habit Femme.jpg',
                'category_id' => $pourFemmes->id,
            ],
            [
                'nom' => 'Accessoires',
                'description' => 'Élégant.',
                'prix' => 1500,
                'ancien_prix' => 2500,
                'photo' => 'products/Accessoire.jpg',
                'category_id' => $modeAccessoires->id,
            ],
            [
                'nom' => 'Complet Femme',
                'description' => 'Élégant.',
                'prix' => 1500,
                'ancien_prix' => 1000,
                'photo' => 'products/femme complet.jpg',
                'category_id' => $pourFemmes->id,
            ],
            [
                'nom' => 'Accessoires',
                'description' => 'Tailles adaptées au marché africain',
                'prix' => 15000,
                'ancien_prix' => 25000,
                'photo' => 'products/acce3.jpg',
                'category_id' => $modeAccessoires->id,
            ],
            [
                'nom' => 'Accessoires',
                'description' => "Tendances directement d'Europe et d'Asie",
                'prix' => 18000,
                'ancien_prix' => 20000,
                'photo' => 'products/acce2.jpg',
                'category_id' => $modeAccessoires->id,
            ],
            [
                'nom' => 'Accessoires',
                'description' => 'Marques exclusives introuvables au Togo',
                'prix' => 20000,
                'ancien_prix' => 18000,
                'photo' => 'products/acce1.jpg',
                'category_id' => $modeAccessoires->id,
            ],
        ];

        foreach ($products as $product) {
            Produits::create($product);
        }

        $this->command->info('Produits insérés avec succès.');
    }
}
