<?php

namespace App\Notifications;

use App\Models\Advertisement;
use Illuminate\Notifications\Notification;

class AdvertisementApproved extends Notification
{
    public function __construct(
        public Advertisement $advertisement
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type'             => 'ad_approved',
            'sender_name'      => 'Admin',
            'message'          => 'Your advertisement "' . $this->advertisement->title . '" has been approved and is now live!',
            'advertisement_id' => $this->advertisement->id,
        ];
    }
}
