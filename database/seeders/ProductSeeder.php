<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
Product::query()->delete();

        $products = [
            [
                'name' => 'Chaussures Femme',
                'description' => 'Chaussures élégantes pour toutes les occasions.',
                'price' => 12000,
                'old_price' => 15000, // <== Ajout ici
                'image' => 'products/chaussure.jpg', // va utiliser l'image par défaut
                'category' => 'habit femme', // <== Ajout ici
            ],
            [
                'name' => 'Montre Homme',
                'description' => 'Montre élégante et résistante à l\'eau.',
                'price' => 18000,
                'old_price' => 20000, // <== Ajout ici
                'image' => 'products/montre.jpg', // image à créer dans storage
                'category' => 'vetements pour homme', // <== Ajout ici
            ],
            [
                'name' => 'Sac à dos',
                'description' => 'Un sac stylé pour vos sorties.',
                'price' => 9500,
                'old_price' => 10000, // <== Ajout ici
                'image' => 'products/sac.jpg', // image à créer dans storage
                    'category' => 'sacs pour femme', // <== Ajout ici
            ],
            [
                'name' => 'casque femme',
                'description' => ' stylé .',
                'price' => 1000,
                'old_price' => 1500, // <== Ajout ici
                'image' => 'products/casque.jpg', // image à créer dans storage
                    'category' => 'casques', // <== Ajout ici
            ],

            [
                'name' => 'Chaussure Homme',
                'description' => ' Chaussures élégantes .',
                'price' => 9000,
                'old_price' => 12000, // <== Ajout ici
                'image' => 'products/Chaussure Homme.jpg', 
                'category' => 'Chaussures pour Homme', 
            ],
            [
                'name' => 'Habit Femme',
                'description' => '  élégant .',
                'price' => 10500,
                'old_price' => 11500, 
                'image' => 'products/Habit Femme.jpg', 
                'category' => 'vetements pour femme ', 
            ],
            [
                'name' => 'Accessoires',
                'description' => '  élégant .',
                'price' => 1500,
                'old_price' =>2500, 
                'image' => 'products/Accessoire.jpg',
                'category' => 'Accessoires', 
            ],
            [
                'name' => ' Complet Femme',
                'description' => '  élégant .',
                'price' => 1500,
                'old_price' =>1000, 
                'image' => 'products/femme complet.jpg',
                'category' => 'vetements pour femme', 
            ],


        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
