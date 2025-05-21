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
                'image' => 'products/chaussure.jpg', // va utiliser l'image par défaut
                'category' => 'habit femme', // <== Ajout ici
            ],
            [
                'name' => 'Montre Homme',
                'description' => 'Montre élégante et résistante à l\'eau.',
                'price' => 18000,
                'image' => 'products/montre.jpg', // image à créer dans storage
                'category' => 'habit homme', // <== Ajout ici
            ],
            [
                'name' => 'Sac à dos',
                'description' => 'Un sac stylé pour vos sorties.',
                'price' => 9500,
                'image' => 'products/sac.jpg', // image à créer dans storage
                    'category' => 'sac femme', // <== Ajout ici
            ],
            [
                'name' => 'casque femme',
                'description' => ' stylé .',
                'price' => 9500,
                'image' => 'products/casque.jpg', // image à créer dans storage
                    'category' => 'casque femme', // <== Ajout ici
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
