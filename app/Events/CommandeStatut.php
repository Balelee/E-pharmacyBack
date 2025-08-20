<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommandeStatut implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $orderId;
    public $status;

    /**
     * Crée un nouvel événement.
     */
    public function __construct($orderId, $status)
    {
        $this->orderId = $orderId;
        $this->status = $status;
    }

    /**
     * Canal de diffusion.
     * Le client écoutera "private-client.{orderId}".
     */
    public function broadcastOn()
    {
        return new PrivateChannel('client.' . $this->orderId);
    }

    /**
     * Nom de l’événement côté front.
     */
    public function broadcastAs()
    {
        return 'commande.statut';
    }
}
