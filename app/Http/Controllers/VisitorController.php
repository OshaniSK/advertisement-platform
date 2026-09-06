<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Message;
use App\Models\Favorite;

class VisitorController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        // Fetch user's favorites
        $favorites = Favorite::where('user_id', $user->id)
            ->with('advertisement')
            ->latest()
            ->take(6)
            ->get();

        // Fetch recent conversation threads
        $messages = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->with(['sender', 'receiver', 'advertisement'])
            ->latest()
            ->get()
            ->unique(function ($message) use ($user) {
                $otherUserId = (int) $message->sender_id === (int) $user->id
                    ? $message->receiver_id
                    : $message->sender_id;
                return $message->advertisement_id . '-' . $otherUserId;
            })
            ->take(5);

        // Fetch recent notifications
        $notifications = $user->notifications()->take(5)->get();

        // Count unread messages
        $unreadMessages = Message::where('receiver_id', $user->id)
            ->whereNull('read_at')
            ->count();

        return view('visitor.dashboard', compact(
            'favorites',
            'messages',
            'notifications',
            'unreadMessages'
        ));
    }
}