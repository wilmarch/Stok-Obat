<?php

namespace App\Listeners;

use App\Events\PurchaseOutStock;
use App\Models\User;
use App\Notifications\StockAlert;

class NotifyStockAlert
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PurchaseOutStock  $event
     * @return void
     */
    public function handle(PurchaseOutStock $event)
    {
        $users = User::get();
        foreach ($users as $user) {
            $user->notify(new StockAlert($event->data));
        }
    }
}
