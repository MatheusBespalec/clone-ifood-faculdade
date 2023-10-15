<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Vonage\Client;

class WhatsAppChannel
{
    /**
     * Send the whatszap notification.
     */
    public function send(object $notifiable, Notification $notification): void
    {
        app(Client::class)
            ->messages()
            ->send($notification->toWhatsApp($notifiable));
    }
}
