<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Pharmacy;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    protected function data(): array
    {
        return [
            [
                'productImage' => 'produits/diclo.jpg',
                'productName' => 'Diclore',
                'description' => 'Produit contre le rhume',
                'price' => '3500',
                'stock' => 10,
                'expiredDate' => '2025-12-12',
                'laborator' => 'Saint Camille-France',
            ],
            [
                'productImage' => 'produits/dafalgan.jpg',
                'productName' => 'Dafalgan',
                'description' => 'Antalgique et antipyrétique',
                'price' => '1700',
                'stock' => 14,
                'expiredDate' => '2027-04-22',
                'laborator' => 'Laboratoire Suisse',
            ],
            [
                'productImage' => 'produits/doliprane.jpg',
                'productName' => 'Doliprane',
                'description' => 'Paracétamol pour la fièvre et la douleur',
                'price' => '1100',
                'stock' => 28,
                'expiredDate' => '2028-01-10',
                'laborator' => 'Laboratoire Sanofi',
            ],
            [
                'productImage' => 'produits/medrol.jpg',
                'productName' => 'Médrol',
                'description' => 'Corticoïde anti-inflammatoire',
                'price' => '5000',
                'stock' => 5,
                'expiredDate' => '2027-06-12',
                'laborator' => 'Laboratoire USA',
            ],
        ];
    }

    public function run()
    {
        Product::truncate();

        foreach ($this->data() as $product) {
            Product::create(array_merge($product, [
                'pharmacy_id' => Pharmacy::inRandomOrder()->value('id'),
            ]));
        }
    }
}
