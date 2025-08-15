<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProduitDemande implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $orderId;

    public $produits;

    public $radius;

    public $pharmacyId;

    public function __construct($orderId, $produits, $radius, $pharmacyId)
    {
        $this->orderId = $orderId;
        $this->produits = $produits;
        $this->radius = $radius;
        $this->pharmacyId = $pharmacyId;
    }

    public function broadcastOn()
    {
        // return new PrivateChannel('pharmacies');
        return new PrivateChannel('pharmacy.' . $this->pharmacyId);
    }

    public function broadcastAs()
    {
        return 'produit.demande';
    }
}
