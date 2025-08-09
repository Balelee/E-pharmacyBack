<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProduitDemande implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $orderId;

    public $produits;

    public $radius;

    public function __construct($orderId, $produits, $radius)
    {
        $this->orderId = $orderId;
        $this->produits = $produits;
        $this->radius = $radius;
    }

    public function broadcastOn()
    {
        // Ici, tu peux utiliser un channel public ou privé
        // PublicChannel = Channel('pharmacies')
        // mais mieux : channel par pharmacie, ex: pharmacy.{id}
        return new Channel('pharmacies');
    }

    public function broadcastAs()
    {
        return 'produit.demande';
    }
}
