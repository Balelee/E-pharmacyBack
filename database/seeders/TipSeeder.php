<?php

namespace Database\Seeders;

use App\Models\Tip;
use App\Models\DailyTip;
use Illuminate\Database\Seeder;

class TipSeeder extends Seeder
{
    public function run()
    {
        $tips = [
            [
                'title' => 'Disponibilité des médicaments',
                'content' => 'Avant de passer commande, assurez-vous que le produit est en stock dans la pharmacie choisie.',
                'icon' => 'medicine_bottle',
            ],
            [
                'title' => 'Pharmacie de garde',
                'content' => 'En cas d’urgence, consultez la liste des pharmacies de garde disponibles près de chez vous.',
                'icon' => 'local_pharmacy',
            ],
            [
                'title' => 'Prescriptions médicales',
                'content' => 'Ne commandez que les médicaments prescrits par votre médecin pour éviter tout risque.',
                'icon' => 'prescription',
            ],
            [
                'title' => 'Horaires des pharmacies',
                'content' => 'Vérifiez les horaires d’ouverture avant de vous déplacer en pharmacie.',
                'icon' => 'schedule',
            ],
            [
                'title' => 'Contactez le support',
                'content' => 'Pour toute question sur votre commande ou la disponibilité d’un produit, contactez notre service client.',
                'icon' => 'support_agent',
            ],
        ];

        foreach ($tips as $tip) {
            Tip::create($tip);
        }
    }
}
