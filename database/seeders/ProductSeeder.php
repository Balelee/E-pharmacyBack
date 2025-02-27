<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    protected function data(): array
    {
        return [
            [
                'productName' => 'Diclore',
                'description' => 'Produit contre le rhume',
                'price' => '3500',
                'stock' => 10,
                'expiredDate' => '2025-12-12', // Format correct pour MySQL
                'laborator' => 'Saint Camille-France',
            ],
            [
                'productName' => 'Humex',
                'description' => 'Produit pour la fièvre',
                'price' => '1500',
                'stock' => 15,
                'expiredDate' => '2027-12-12',
                'laborator' => 'USA',
            ],
            [
                'productName' => 'Paracetamol',
                'description' => 'Produit contre la douleur',
                'price' => '100',
                'stock' => 10,
                'expiredDate' => '2028-12-12',
                'laborator' => 'Laboratoire de Koweït',
            ],
            [
                'productName' => 'Maloox',
                'description' => 'Produit contre ulcère',
                'price' => '1110',
                'stock' => 10,
                'expiredDate' => '2026-12-12',
                'laborator' => 'Laboratoire Finlande',
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
