<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Message;

class AdvertiserController extends Controller
{
    public function dashboard()
    {
        $advertisements = Advertisement::where('user_id', auth()->id())
            ->latest()
            ->get();

        $messages = Message::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with(['sender', 'receiver', 'advertisement'])
            ->latest()
            ->get()
            ->unique(function ($message) {
                $otherUserId = $message->sender_id === auth()->id() ? $message->receiver_id : $message->sender_id;
                return $message->advertisement_id . '-' . $otherUserId;
            });

        return view('advertiser.dashboard', compact('advertisements', 'messages'));
    }
}