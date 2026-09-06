<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class NotificationController extends Controller
{
    /**
     * Display all notifications.
     */
    public function index()
    {
        $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->paginate(15);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead(string $notification): RedirectResponse
    {
        $user = auth()->user();

        $user->notifications()
            ->where('id', $notification)
            ->update([
                'read_at' => now(),
            ]);

        return back();
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(): RedirectResponse
    {
        auth()->user()
            ->unreadNotifications
            ->markAsRead();

        return back()->with(
            'success',
            'All notifications marked as read.'
        );
    }

    /**
     * Open a notification.
     *
     * Marks it as read and opens the related conversation.
     */
    public function open(string $notification): RedirectResponse
    {
        $user = auth()->user();

        $notificationModel = $user->notifications()
            ->where('id', $notification)
            ->firstOrFail();

        // Mark notification as read
        if (is_null($notificationModel->read_at)) {
            $notificationModel->markAsRead();
        }

        // Get notification data
        $data = $notificationModel->data;

        // Make sure this notification belongs to a message
        if (
            !isset($data['advertisement_id']) ||
            !isset($data['sender_id'])
        ) {
            return redirect()
                ->route('notifications.index')
                ->with('error', 'This notification cannot be opened.');
        }

        return redirect()->route('messages.conversation', [
            'advertisement' => $data['advertisement_id'],
            'other_user' => $data['sender_id'],
        ]);
    }
}