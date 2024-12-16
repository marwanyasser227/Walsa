<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AccountCreatedNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase()
    {
        return [
            'message' => 'لقد تم إنشاء حسابك بنجاح ... مرحبًا بك😍',
        ];
    }
}
