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
        if ($advertisement->status !== 'approved') {
            abort(404);
        }

        if (auth()->id() === $advertisement->user_id) {
            abort(403, 'You cannot message yourself.');
        }

        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

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
     * Show a conversation.
     */
    public function conversation(
        Advertisement $advertisement,
        User $other_user
    ) {
        /*
        |--------------------------------------------------------------------------
        | Check advertisement
        |--------------------------------------------------------------------------
        */

        if ($advertisement->status !== 'approved') {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | The other user cannot be the logged-in user
        |--------------------------------------------------------------------------
        */

        if (auth()->id() === $other_user->id) {
            abort(403, 'Invalid conversation.');
        }


        /*
        |--------------------------------------------------------------------------
        | The other user must be the advertisement owner
        |--------------------------------------------------------------------------
        */

        if ($other_user->id !== $advertisement->user_id) {
            abort(403, 'This user is not the seller of this advertisement.');
        }


        /*
        |--------------------------------------------------------------------------
        | Check that logged-in user is actually part of this conversation
        |--------------------------------------------------------------------------
        */

        $conversationExists = Message::where('advertisement_id', $advertisement->id)
            ->where(function ($query) use ($other_user) {

                $query->where(function ($q) use ($other_user) {

                    $q->where('sender_id', auth()->id())
                        ->where('receiver_id', $other_user->id);

                })
                ->orWhere(function ($q) use ($other_user) {

                    $q->where('sender_id', $other_user->id)
                        ->where('receiver_id', auth()->id());

                });

            })
            ->exists();


        if (!$conversationExists) {
            abort(403, 'Conversation not found.');
        }


        /*
        |--------------------------------------------------------------------------
        | Mark received messages as read
        |--------------------------------------------------------------------------
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

                $query->where(function ($q) use ($other_user) {

                    $q->where('sender_id', auth()->id())
                        ->where('receiver_id', $other_user->id);

                })
                ->orWhere(function ($q) use ($other_user) {

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
        /*
        |--------------------------------------------------------------------------
        | Check advertisement
        |--------------------------------------------------------------------------
        */

        if ($advertisement->status !== 'approved') {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Cannot message yourself
        |--------------------------------------------------------------------------
        */

        if (auth()->id() === $other_user->id) {
            abort(403, 'You cannot message yourself.');
        }


        /*
        |--------------------------------------------------------------------------
        | The other user must be the advertisement owner
        |--------------------------------------------------------------------------
        */

        if ($other_user->id !== $advertisement->user_id) {
            abort(403, 'This user is not the seller of this advertisement.');
        }


        /*
        |--------------------------------------------------------------------------
        | Make sure logged-in user is part of the conversation
        |--------------------------------------------------------------------------
        */

        $conversationExists = Message::where('advertisement_id', $advertisement->id)
            ->where(function ($query) use ($other_user) {

                $query->where(function ($q) use ($other_user) {

                    $q->where('sender_id', auth()->id())
                        ->where('receiver_id', $other_user->id);

                })
                ->orWhere(function ($q) use ($other_user) {

                    $q->where('sender_id', $other_user->id)
                        ->where('receiver_id', auth()->id());

                });

            })
            ->exists();


        if (!$conversationExists) {
            abort(403, 'Conversation not found.');
        }


        /*
        |--------------------------------------------------------------------------
        | Validate message
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Save message
        |--------------------------------------------------------------------------
        */

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $other_user->id,
            'advertisement_id' => $advertisement->id,
            'message' => $validated['message'],
        ]);


        return back()->with('success', 'Message sent!');
    }
}
