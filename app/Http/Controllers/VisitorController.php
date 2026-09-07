<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Favorite;
use App\Models\Message;

class VisitorController extends Controller
{
    /**
     * Visitor Dashboard
     */
    public function dashboard()
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Dashboard Statistics
        |--------------------------------------------------------------------------
        */

        // Favorite count
        $favoriteCount = Favorite::where(
            'user_id',
            $user->id
        )->count();

        // Message count
        $messageCount = Message::where(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                  ->orWhere('receiver_id', $user->id);
        })->count();

        // Notification count
        $notificationCount = $user->unreadNotifications()->count();


        /*
        |--------------------------------------------------------------------------
        | Recently Added Advertisements
        |--------------------------------------------------------------------------
        */

        $recentAdvertisements = Advertisement::where(
            'status',
            'approved'
        )
            ->with(['images', 'user'])
            ->latest()
            ->take(6)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Send Data To Dashboard
        |--------------------------------------------------------------------------
        */

        return view(
            'visitor.dashboard',
            compact(
                'user',
                'favoriteCount',
                'messageCount',
                'notificationCount',
                'recentAdvertisements'
            )
        );
    }
}

