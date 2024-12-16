<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ShipmentUpdated;
use App\Notifications\ShipmentUpdatedNotification;
use Illuminate\Support\Facades\Notification;

class NotifyUserOfShipmentUpdate
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ShipmentUpdated $event)
    {
        $user = $event->shipment->user;
        Notification::send($user, new ShipmentUpdatedNotification($event->shipment));
    }
}
