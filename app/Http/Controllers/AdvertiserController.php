<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Message;

class AdvertiserController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        if (strtolower(trim($user->role)) === 'visitor') {
            return redirect()->route('visitor.dashboard');
        }

        if (strtolower(trim($user->role)) === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if (strtolower(trim($user->role)) !== 'advertiser') {
            abort(403, 'Unauthorized');
        }

        $advertisements = Advertisement::where('user_id', auth()->id())
            ->latest()
            ->get();

        $messages = Message::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with(['sender', 'receiver', 'advertisement'])
            ->latest()
            ->get()
            ->unique(function ($message) {
                $otherUserId = (int) $message->sender_id === (int) auth()->id()
                    ? $message->receiver_id
                    : $message->sender_id;

                return $message->advertisement_id . '-' . $otherUserId;
            });

        // Count unread messages received by the advertiser
        $unreadMessages = Message::where('receiver_id', auth()->id())
            ->whereNull('read_at')
            ->count();

        return view('advertiser.dashboard', compact(
            'advertisements',
            'messages',
            'unreadMessages'
        ));
    }
}