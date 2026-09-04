<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Send a new message from a visitor to an advertiser.
     */
    public function send(Request $request, Advertisement $advertisement)
    {
        // Make sure the advertisement is approved
        if ($advertisement->status !== 'approved') {
            abort(404);
        }

        // Prevent the advertiser from messaging themselves
        if (auth()->id() === $advertisement->user_id) {
            abort(403, 'You cannot message yourself.');
        }

        // Validate the message
        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        // Create the message
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
     * Reply to an existing message.
     */
    public function reply(Request $request, Message $message)
    {
        // Only the receiver of the original message can reply
        if ($message->receiver_id !== auth()->id()) {
            abort(403, 'You are not allowed to reply to this message.');
        }

        // Validate the reply
        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        // Create the reply
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
     * Show the user's message inbox.
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
     * Show a conversation between two users for an advertisement.
     */
    public function conversation(
        Advertisement $advertisement,
        User $other_user
    ) {
        // Advertisement must be approved
        if ($advertisement->status !== 'approved') {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Mark unread messages as read
        |--------------------------------------------------------------------------
        |
        | Find messages:
        | - belonging to this advertisement
        | - sent by the other user
        | - received by the logged-in user
        | - not already read
        |
        */

        Message::where('advertisement_id', $advertisement->id)
            ->where('sender_id', $other_user->id)
            ->where('receiver_id', auth()->id())
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);


        /*
        |--------------------------------------------------------------------------
        | Get conversation messages
        |--------------------------------------------------------------------------
        */

        $messages = Message::where(
            'advertisement_id',
            $advertisement->id
        )
            ->where(function ($query) use ($other_user) {

                // Messages sent by logged-in user
                $query->where(function ($q) use ($other_user) {

                    $q->where(
                        'sender_id',
                        auth()->id()
                    )
                    ->where(
                        'receiver_id',
                        $other_user->id
                    );

                })

                // Messages received from other user
                ->orWhere(function ($q) use ($other_user) {

                    $q->where(
                        'sender_id',
                        $other_user->id
                    )
                    ->where(
                        'receiver_id',
                        auth()->id()
                    );

                });

            })
            ->with([
                'sender',
                'receiver'
            ])
            ->oldest()
            ->get();


        // If there are no messages, don't open the conversation
        if ($messages->isEmpty()) {
            abort(403, 'Conversation not found.');
        }


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
        // Advertisement must be approved
        if ($advertisement->status !== 'approved') {
            abort(404);
        }

        // Prevent users from messaging themselves
        if (auth()->id() === $other_user->id) {
            abort(403, 'You cannot message yourself.');
        }

        // Validate the message
        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        // Create the message
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $other_user->id,
            'advertisement_id' => $advertisement->id,
            'message' => $validated['message'],
        ]);

        return back()->with('success', 'Message sent!');
    }
}