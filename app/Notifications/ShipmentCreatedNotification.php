<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ShipmentCreatedNotification extends Notification
{
    use Queueable;
    public $shipment;

    public function __construct($shipment){
        $this->shipment = $shipment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'لقد تم إنشاء شحنتك رقم  '.$this->shipment->trackNumber." بنجاح😊",
        ];
    }
}
