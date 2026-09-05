<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Message;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Send the first message to an advertisement seller.
     */
    public function send(Request $request, Advertisement $advertisement)
    {
        // Only approved advertisements can receive messages.
        if ($advertisement->status !== 'approved') {
            abort(404);
        }

        // Seller cannot message themselves.
        if (auth()->id() === $advertisement->user_id) {
            abort(403, 'You cannot message yourself.');
        }

        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Message
        |--------------------------------------------------------------------------
        */

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $advertisement->user_id,
            'advertisement_id' => $advertisement->id,
            'message' => $validated['message'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Load Relationships
        |--------------------------------------------------------------------------
        */

        $message->load([
            'sender',
            'advertisement',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Send Notification To Seller
        |--------------------------------------------------------------------------
        */

        $advertisement->user->notify(
            new NewMessageNotification($message)
        );

        return redirect()
            ->route('advertisements.show', $advertisement)
            ->with('success', 'Message sent successfully!');
    }


    /**
     * Reply to a message.
     */
    public function reply(Request $request, Message $message)
    {
        // Only the receiver of the original message can reply.
        if ($message->receiver_id !== auth()->id()) {
            abort(403, 'You are not allowed to reply to this message.');
        }

        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Reply
        |--------------------------------------------------------------------------
        */

        $newMessage = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $message->sender_id,
            'advertisement_id' => $message->advertisement_id,
            'message' => $validated['message'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Load Relationships
        |--------------------------------------------------------------------------
        */

        $newMessage->load([
            'sender',
            'advertisement',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Send Notification To Original Sender
        |--------------------------------------------------------------------------
        */

        $message->sender->notify(
            new NewMessageNotification($newMessage)
        );

        return redirect()
            ->route('advertiser.dashboard')
            ->with('success', 'Reply sent successfully!');
    }


    /**
     * Display the user's message inbox.
     */
    public function inbox()
    {
        $messages = Message::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with([
                'sender',
                'receiver',
                'advertisement',
            ])
            ->latest()
            ->get()
            ->unique(function ($message) {

                $otherUserId = (int) $message->sender_id === (int) auth()->id()
                    ? $message->receiver_id
                    : $message->sender_id;

                return $message->advertisement_id . '-' . $otherUserId;
            });

        return view(
            'messages.inbox',
            compact('messages')
        );
    }


    /**
     * Display a conversation between two users
     * for a specific advertisement.
     */
    public function conversation(
        Advertisement $advertisement,
        User $other_user
    ) {
        // Only approved advertisements can have conversations.
        if ($advertisement->status !== 'approved') {
            abort(404);
        }

        // User cannot have a conversation with themselves.
        if (auth()->id() === $other_user->id) {
            abort(403, 'Invalid conversation.');
        }

        /*
        |--------------------------------------------------------------------------
        | Check Whether Conversation Exists
        |--------------------------------------------------------------------------
        */

        $conversationExists = Message::where(
            'advertisement_id',
            $advertisement->id
        )
            ->where(function ($query) use ($other_user) {

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
            ->exists();

        if (!$conversationExists) {
            abort(403, 'Conversation not found.');
        }

        /*
        |--------------------------------------------------------------------------
        | Mark Received Messages As Read
        |--------------------------------------------------------------------------
        */

        Message::where(
            'advertisement_id',
            $advertisement->id
        )
            ->where(
                'sender_id',
                $other_user->id
            )
            ->where(
                'receiver_id',
                auth()->id()
            )
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);

        /*
        |--------------------------------------------------------------------------
        | Get Conversation Messages
        |--------------------------------------------------------------------------
        */

        $messages = Message::where(
            'advertisement_id',
            $advertisement->id
        )
            ->where(function ($query) use ($other_user) {

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
                'receiver',
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
        // Only approved advertisements can be used.
        if ($advertisement->status !== 'approved') {
            abort(404);
        }

        // User cannot message themselves.
        if (auth()->id() === $other_user->id) {
            abort(403, 'You cannot message yourself.');
        }

        /*
        |--------------------------------------------------------------------------
        | Check Whether Conversation Exists
        |--------------------------------------------------------------------------
        */

        $conversationExists = Message::where(
            'advertisement_id',
            $advertisement->id
        )
            ->where(function ($query) use ($other_user) {

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
            ->exists();

        if (!$conversationExists) {
            abort(403, 'Conversation not found.');
        }

        /*
        |--------------------------------------------------------------------------
        | Validate Message
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Message
        |--------------------------------------------------------------------------
        */

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $other_user->id,
            'advertisement_id' => $advertisement->id,
            'message' => $validated['message'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Load Relationships
        |--------------------------------------------------------------------------
        */

        $message->load([
            'sender',
            'advertisement',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Send Notification
        |--------------------------------------------------------------------------
        */

        $other_user->notify(
            new NewMessageNotification($message)
        );

        return back()
            ->with('success', 'Message sent!');
    }
}