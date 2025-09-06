<?php

namespace App\Observers;

use App\Events\CommandeStatut;
use App\Models\OrderPharmacy;
use Illuminate\Support\Facades\DB;

class OrderPharmacyObserver
{
    /**
     * Handle the OrderPharmacy "created" event.
     */
    public function created(OrderPharmacy $orderPharmacy): void
    {

        DB::afterCommit(function () use ($orderPharmacy) {
            $orderPharmacy->load([
                'orderpharmacydetails.orderDetail',
                'pharmacy'
            ]);
            event(new CommandeStatut($orderPharmacy));
        });
    }

    /**
     * Handle the OrderPharmacy "updated" event.
     */
    public function updated(OrderPharmacy $orderPharmacy): void
    {
        DB::afterCommit(function () use ($orderPharmacy) {
            $orderPharmacy->load('orderpharmacydetails');
            event(new CommandeStatut($orderPharmacy));
        });
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
