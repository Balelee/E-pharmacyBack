<?php

namespace App\Events;

use App\Http\Resources\OrderPharmacyResource;
use App\Models\OrderPharmacy;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PharmacyCount
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $orderPharmacy;

    public function __construct(OrderPharmacy $orderPharmacy)
    {
        $this->orderPharmacy = $orderPharmacy;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('pharmacy-count.' . $this->orderPharmacy->order_id);
    }

    /**
     * Nom de l’événement côté front.
     */
    public function broadcastAs()
    {
        return 'commande.traitement.count';
    }

    public function broadcastWith()
    {
        return [
           'treated_count' => $this->orderPharmacy->treated_count,
        ];
    }
}
