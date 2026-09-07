<?php

namespace App\Notifications;

use App\Models\Advertisement;
use Illuminate\Notifications\Notification;

class AdvertisementRejected extends Notification
{
    public function __construct(
        public Advertisement $advertisement,
        public string $reason
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type'             => 'ad_rejected',
            'sender_name'      => 'Admin',
            'message'          => 'Your advertisement "' . $this->advertisement->title . '" was rejected. Reason: ' . $this->reason,
            'advertisement_id' => $this->advertisement->id,
            'rejection_reason' => $this->reason,
        ];
    }
}
