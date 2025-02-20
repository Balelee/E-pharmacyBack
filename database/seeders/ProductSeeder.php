<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    protected function data(): array
    {
        return [
            [
                'productName' => 'Diclore',
                'description' => 'Prouit contre le rhume',
                'price' => '3500',
                'productType' => 'Sirop',
                'stock' => 10,
                'expiredDate' => '12-12-2025',
                'laborator' => 'Saint Camille-France',
            ],
            [
                'productName' => 'Humex',
                'description' => 'Produit pour la fièvre',
                'price' => '1500',
                'productType' => 'Comprimé',
                'stock' => 15,
                'expiredDate' => '12-12-2027',
                'laborator' => 'USA',
            ],
            [
                'productName' => 'Paracetamol',
                'description' => 'Prouit contre la douleur',
                'price' => '100',
                'productType' => 'Comprimé',
                'stock' => 10,
                'expiredDate' => '12-12-2028',
                'laborator' => 'Laboratoire de Koweit',
            ],
            [
                'productName' => 'Maloox',
                'description' => 'Produit contre ulcère',
                'price' => '1110',
                'productType' => 'Sachet',
                'stock' => 10,
                'expiredDate' => '12-12-2026',
                'laborator' => 'Laborator finlande',
            ],
        ];
    }

    public function run()
    {
        Product::truncate();
        foreach ($this->data() as $product) {
            Product::create($product);
        }
    }
}
