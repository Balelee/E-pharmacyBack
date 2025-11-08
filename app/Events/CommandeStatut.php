<?php

namespace App\Events;

use App\Http\Resources\OrderPharmacyResource;
use App\Models\OrderPharmacy;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommandeStatut implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $orderPharmacy;

    public function __construct(OrderPharmacy $orderPharmacy)
    {
        $this->orderPharmacy = $orderPharmacy;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('client.'.$this->orderPharmacy->order_id);
    }

    /**
     * Nom de l’événement côté front.
     */
    public function broadcastAs()
    {
        return 'commande.statut';
    }

    public function broadcastWith()
    {
        return [
            'requestPharmacy' => new OrderPharmacyResource($this->orderPharmacy),
        ];
    }
}
