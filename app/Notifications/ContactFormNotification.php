<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ContactFormNotification extends Notification
{
    use Queueable;

    protected $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase()
    {
        return [
            'message' => $this->details,

        ];
    }
}
