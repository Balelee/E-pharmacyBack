<?php

namespace App\Jobs;

use App\Events\ProduitDemande;
use App\Models\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class BroadcastToPharmaciesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderId;

    protected $radius;

    protected $elapsedMinutes;

    public function __construct($orderId, $radius = 2, $elapsedMinutes = 0)
    {
        $this->orderId = $orderId;
        $this->radius = $radius;
        $this->elapsedMinutes = $elapsedMinutes;
    }

    public function handle()
    {
        $order = Order::find($this->orderId);
        if (! $order || $order->orderStatus !== OrderStatus::ENATTENTE) {
            return; // stop si la commande est déjà traitée ou inexistante
        }

        // Chercher pharmacies dans le rayon
        $pharmacies = DB::select('
        SELECT id, name, lat, lng,
        (6371 * acos(
            cos(radians(?)) * cos(radians(lat)) *
            cos(radians(lng) - radians(?)) +
            sin(radians(?)) * sin(radians(lat))
        )) AS distance
        FROM pharmacies
        HAVING distance <= ?
        ORDER BY distance
    ', [
            $order->lat,
            $order->lng,
            $order->lat,
            $this->radius,
        ]);
        \Log::info("BroadcastToPharmaciesJob exécuté pour la commande {$this->orderId} avec radius {$this->radius} et elapsed {$this->elapsedMinutes} minutes");
        $liste = collect($pharmacies)
            ->map(function ($p, $index) {
                return ($index + 1) . ' -> ' . $p->name;
            })
            ->implode(",\n"); // retour à la ligne

        \Log::info("Pharmacies trouvées par le job :\n" . $liste);


        // Broadcast vers le channel général (pour test) ou vers chaque pharmacie
        foreach ($pharmacies as $p) {
            if ($p->id != null) {
                broadcast(new ProduitDemande($order->id, $order->details, $this->radius, $p->id))
                    ->toOthers();
            }
        }



        // Vérifier si réponse reçue => on stoppe
        $order->refresh();
        if ($order->orderStatus !== OrderStatus::ENATTENTE) {
            return;
        }

        // Timeout global
        if ($this->elapsedMinutes >= 30) {
            $order->update(['orderStatus' => OrderStatus::EXPIRE->value]);

            return;
        }


        // Planifier l’étape suivante dans 3 minutes avec un rayon élargi
        $nextRadius = $this->radius + 2;
        dispatch(new BroadcastToPharmaciesJob($this->orderId, $nextRadius, $this->elapsedMinutes + 3))
            ->delay(now()->addMinutes(1));
    }
}
