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
                'expiredDate' => '2025-12-12',
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
            [
                'productName' => 'Ibuprofène',
                'description' => 'Anti-inflammatoire et antidouleur',
                'price' => '1200',
                'stock' => 20,
                'expiredDate' => '2026-06-15',
                'laborator' => 'Laboratoire Suisse',
            ],
            [
                'productName' => 'Efferalgan',
                'description' => 'Médicament contre la fièvre et la douleur',
                'price' => '1300',
                'stock' => 25,
                'expiredDate' => '2027-09-10',
                'laborator' => 'Laboratoire France',
            ],
            [
                'productName' => 'Smecta',
                'description' => 'Traitement contre la diarrhée',
                'price' => '800',
                'stock' => 18,
                'expiredDate' => '2025-11-20',
                'laborator' => 'Laboratoire Belgique',
            ],
            [
                'productName' => 'Vitamine C',
                'description' => 'Complément alimentaire pour renforcer l\'immunité',
                'price' => '500',
                'stock' => 30,
                'expiredDate' => '2029-03-05',
                'laborator' => 'Laboratoire Canada',
            ],
            [
                'productName' => 'Omeprazole',
                'description' => 'Traitement des reflux gastriques',
                'price' => '2000',
                'stock' => 12,
                'expiredDate' => '2027-08-14',
                'laborator' => 'Laboratoire Allemagne',
            ],
            [
                'productName' => 'Aspirine',
                'description' => 'Anti-inflammatoire et anticoagulant',
                'price' => '900',
                'stock' => 22,
                'expiredDate' => '2026-05-30',
                'laborator' => 'Laboratoire Espagne',
            ],
            [
                'productName' => 'Dafalgan',
                'description' => 'Antalgique et antipyrétique',
                'price' => '1700',
                'stock' => 14,
                'expiredDate' => '2027-04-22',
                'laborator' => 'Laboratoire Suisse',
            ],
            [
                'productName' => 'Cétirizine',
                'description' => 'Antihistaminique contre les allergies',
                'price' => '600',
                'stock' => 35,
                'expiredDate' => '2026-09-18',
                'laborator' => 'Laboratoire France',
            ],
            [
                'productName' => 'Doliprane',
                'description' => 'Paracétamol pour la fièvre et la douleur',
                'price' => '1100',
                'stock' => 28,
                'expiredDate' => '2028-01-10',
                'laborator' => 'Laboratoire Sanofi',
            ],
            [
                'productName' => 'Gaviscon',
                'description' => 'Traitement contre les brûlures d\'estomac',
                'price' => '2500',
                'stock' => 15,
                'expiredDate' => '2027-12-15',
                'laborator' => 'Laboratoire UK',
            ],
            [
                'productName' => 'Amoxicilline',
                'description' => 'Antibiotique large spectre',
                'price' => '3400',
                'stock' => 8,
                'expiredDate' => '2025-10-30',
                'laborator' => 'Laboratoire Allemagne',
            ],
            [
                'productName' => 'Zyrtec',
                'description' => 'Traitement des allergies saisonnières',
                'price' => '700',
                'stock' => 20,
                'expiredDate' => '2026-07-19',
                'laborator' => 'Laboratoire Belgique',
            ],
            [
                'productName' => 'Médrol',
                'description' => 'Corticoïde anti-inflammatoire',
                'price' => '5000',
                'stock' => 5,
                'expiredDate' => '2027-06-12',
                'laborator' => 'Laboratoire USA',
            ],
            [
                'productName' => 'Toplexil',
                'description' => 'Sirop contre la toux',
                'price' => '950',
                'stock' => 40,
                'expiredDate' => '2025-08-20',
                'laborator' => 'Laboratoire France',
            ],
            [
                'productName' => 'Clamoxyl',
                'description' => 'Antibiotique pour infections bactériennes',
                'price' => '3800',
                'stock' => 12,
                'expiredDate' => '2028-11-22',
                'laborator' => 'Laboratoire Suisse',
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
