<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Message $message
    ) {
    }

    /**
     * Notification delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Store notification in the database.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'message_id' => $this->message->id,

            'advertisement_id' => $this->message->advertisement_id,

            'sender_id' => $this->message->sender_id,

            'sender_name' => $this->message->sender->name,

            'advertisement_title' =>
                $this->message->advertisement->title,

            'message' => $this->message->message,
        ];
    }
}