<?php

namespace App\Observers;

use App\Events\CommandeStatut;
use App\Models\OrderPharmacy;

class OrderPharmacyObserver
{
    /**
     * Handle the OrderPharmacy "created" event.
     */
    public function created(OrderPharmacy $orderPharmacy): void
    {
        event(new CommandeStatut($orderPharmacy->order_id, $orderPharmacy->status));
    }

    /**
     * Handle the OrderPharmacy "updated" event.
     */
    public function updated(OrderPharmacy $orderPharmacy): void
    {
        event(new CommandeStatut($orderPharmacy->order_id, $orderPharmacy->status));
    }

    /**
     * Handle the OrderPharmacy "deleted" event.
     */
    public function deleted(OrderPharmacy $orderPharmacy): void
    {
        //
    }

    /**
     * Handle the OrderPharmacy "restored" event.
     */
    public function restored(OrderPharmacy $orderPharmacy): void
    {
        //
    }

    /**
     * Handle the OrderPharmacy "force deleted" event.
     */
    public function forceDeleted(OrderPharmacy $orderPharmacy): void
    {
        //
    }
}
