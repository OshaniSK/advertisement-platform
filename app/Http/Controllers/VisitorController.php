<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Message;

class VisitorController extends Controller
{
    public function dashboard()
    {
        $advertisements = Advertisement::where('status', 'approved')
            ->latest()
            ->take(6)
            ->get();

        // Count unread messages received by the visitor
        $unreadMessages = Message::where('receiver_id', auth()->id())
            ->whereNull('read_at')
            ->count();

        return view('visitor.dashboard', compact(
            'advertisements',
            'unreadMessages'
        ));
    }
}