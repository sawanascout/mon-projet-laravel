<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::query()->delete();

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
                'name' => 'Chaussure Femme',
                'description' => 'Chaussures élégantes pour toutes les occasions.',
                'price' => 12000,
                'old_price' => 15000,
                'image' => 'products/chaussure.jpg',
                'category_id' => $pourFemmes->id,
            ],
            [
                'name' => 'Montre',
                'description' => 'Montre élégante et résistante à l\'eau.',
                'price' => 18000,
                'old_price' => 20000,
                'image' => 'products/montre.jpg',
                'category_id' => $modeAccessoires->id,
            ],
            [
                'name' => 'Sac à dos',
                'description' => 'Un sac stylé pour vos sorties.',
                'price' => 9500,
                'old_price' => 10000,
                'image' => 'products/sac.jpg',
                'category_id' => $modeAccessoires->id,
            ],
            [
                'name' => 'Casque',
                'description' => 'Stylé.',
                'price' => 1000,
                'old_price' => 1500,
                'image' => 'products/casque.jpg',
                'category_id' => $modeAccessoires->id,
            ],
            [
                'name' => 'Chaussures de tennis',
                'description' => 'Mocassins décontractés en cuir pour hommes',
                'price' => 9000,
                'old_price' => 12000,
                'image' => 'products/Chaussure Homme.jpg',
                'category_id' => $pourHommes->id,
            ],
            [
                'name' => 'Robe longue',
                'description' => 'Élégant.',
                'price' => 10500,
                'old_price' => 11500,
                'image' => 'products/Habit Femme.jpg',
                'category_id' => $pourFemmes->id,
            ],
            [
                'name' => 'Accessoires',
                'description' => 'Élégant.',
                'price' => 1500,
                'old_price' => 2500,
                'image' => 'products/Accessoire.jpg',
                'category_id' => $modeAccessoires->id,
            ],
            [
                'name' => 'Complet Femme',
                'description' => 'Élégant.',
                'price' => 1500,
                'old_price' => 1000,
                'image' => 'products/femme complet.jpg',
                'category_id' => $pourFemmes->id,
            ],
            [
                'name' => 'Accessoires',
                'description' => 'Tailles adaptées au marché africain',
                'price' => 15000,
                'old_price' => 25000,
                'image' => 'products/acce3.jpg',
                'category_id' => $modeAccessoires->id,
            ],
            [
                'name' => 'Accessoires',
                'description' => "Tendances directement d'Europe et d'Asie",
                'price' => 18000,
                'old_price' => 20000,
                'image' => 'products/acce2.jpg',
                'category_id' => $modeAccessoires->id,
            ],
            [
                'name' => 'Accessoires',
                'description' => 'Marques exclusives introuvables au Togo',
                'price' => 20000,
                'old_price' => 18000,
                'image' => 'products/acce1.jpg',
                'category_id' => $modeAccessoires->id,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('Produits insérés avec succès.');
    }
}
