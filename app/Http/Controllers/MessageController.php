<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Send the first message to a seller.
     */
    public function send(Request $request, Advertisement $advertisement)
    {
        // Advertisement must be approved.
        if ($advertisement->status !== 'approved') {
            abort(404);
        }

        // Seller cannot message themselves.
        if (auth()->id() === $advertisement->user_id) {
            abort(403, 'You cannot message yourself.');
        }

        // Validate message.
        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        // Create the message.
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $advertisement->user_id,
            'advertisement_id' => $advertisement->id,
            'message' => $validated['message'],
        ]);

        return redirect()
            ->route('advertisements.show', $advertisement)
            ->with('success', 'Message sent successfully!');
    }


    /**
     * Reply to a message.
     */
    public function reply(Request $request, Message $message)
    {
        // Only the receiver can reply.
        if ($message->receiver_id !== auth()->id()) {
            abort(403, 'You are not allowed to reply to this message.');
        }

        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $message->sender_id,
            'advertisement_id' => $message->advertisement_id,
            'message' => $validated['message'],
        ]);

        return redirect()
            ->route('advertiser.dashboard')
            ->with('success', 'Reply sent successfully!');
    }


    /**
     * Show the user's inbox.
     */
    public function inbox()
    {
        $messages = Message::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with([
                'sender',
                'receiver',
                'advertisement'
            ])
            ->latest()
            ->get()
            ->unique(function ($message) {

                $otherUserId = $message->sender_id === auth()->id()
                    ? $message->receiver_id
                    : $message->sender_id;

                return $message->advertisement_id . '-' . $otherUserId;
            });

        return view('messages.inbox', compact('messages'));
    }


    /**
     * Show a conversation.
     */
    public function conversation(
        Advertisement $advertisement,
        User $other_user
    ) {
        // Advertisement must be approved.
        if ($advertisement->status !== 'approved') {
            abort(404);
        }

        // Cannot have a conversation with yourself.
        if (auth()->id() === $other_user->id) {
            abort(403, 'Invalid conversation.');
        }

        /*
         * Check that a conversation actually exists
         * between the logged-in user and the other user
         * for this advertisement.
         */
        $conversationExists = Message::where(
            'advertisement_id',
            $advertisement->id
        )
            ->where(function ($query) use ($other_user) {

                $query->where(function ($q) use ($other_user) {

                    $q->where('sender_id', auth()->id())
                        ->where('receiver_id', $other_user->id);

                })->orWhere(function ($q) use ($other_user) {

                    $q->where('sender_id', $other_user->id)
                        ->where('receiver_id', auth()->id());

                });

            })
            ->exists();

        // Conversation does not belong to these users.
        if (!$conversationExists) {
            abort(403, 'Conversation not found.');
        }

        /*
         * Mark messages received from the other user
         * as read.
         */
        Message::where('advertisement_id', $advertisement->id)
            ->where('sender_id', $other_user->id)
            ->where('receiver_id', auth()->id())
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);

        /*
         * Get all messages between the two users
         * for this advertisement.
         */
        $messages = Message::where(
            'advertisement_id',
            $advertisement->id
        )
            ->where(function ($query) use ($other_user) {

                $query->where(function ($q) use ($other_user) {

                    $q->where('sender_id', auth()->id())
                        ->where('receiver_id', $other_user->id);

                })->orWhere(function ($q) use ($other_user) {

                    $q->where('sender_id', $other_user->id)
                        ->where('receiver_id', auth()->id());

                });

            })
            ->with([
                'sender',
                'receiver'
            ])
            ->oldest()
            ->get();

        return view(
            'messages.conversation',
            compact(
                'advertisement',
                'other_user',
                'messages'
            )
        );
    }


    /**
     * Send a message inside an existing conversation.
     */
    public function sendMessage(
        Request $request,
        Advertisement $advertisement,
        User $other_user
    ) {
        // Advertisement must be approved.
        if ($advertisement->status !== 'approved') {
            abort(404);
        }

        // Cannot message yourself.
        if (auth()->id() === $other_user->id) {
            abort(403, 'You cannot message yourself.');
        }

        /*
         * Make sure an existing conversation exists
         * between these two users for this advertisement.
         */
        $conversationExists = Message::where(
            'advertisement_id',
            $advertisement->id
        )
            ->where(function ($query) use ($other_user) {

                $query->where(function ($q) use ($other_user) {

                    $q->where('sender_id', auth()->id())
                        ->where('receiver_id', $other_user->id);

                })->orWhere(function ($q) use ($other_user) {

                    $q->where('sender_id', $other_user->id)
                        ->where('receiver_id', auth()->id());

                });

            })
            ->exists();

        if (!$conversationExists) {
            abort(403, 'Conversation not found.');
        }

        // Validate the new message.
        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        // Save the message.
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $other_user->id,
            'advertisement_id' => $advertisement->id,
            'message' => $validated['message'],
        ]);

        return back()->with('success', 'Message sent!');
    }
}
