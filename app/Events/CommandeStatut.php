<?php

namespace App\Events;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderPharmacy;
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

    public function broadcastWith()
    {
        $orderPharmacy = OrderPharmacy::with('details')->find($this->orderId);

        return [
            "orderPharmacy" => [
                "id" => $orderPharmacy->id,
                "order_id" => $orderPharmacy->order_id,
                "pharmacy_id" => $orderPharmacy->pharmacy_id,
                "status" => $orderPharmacy->status,
                "details" => $orderPharmacy->details->map(function ($detail) {
                    return [
                        "id" => $detail->id,
                        "order_detail_id" => $detail->order_detail_id,
                        "available" => $detail->available,
                        "quantity" => $detail->quantity,
                        "price" => $detail->price,
                        "total" => $detail->total,
                    ];
                }),
            ],
        ];
    }
}
