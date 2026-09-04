<!DOCTYPE html>
<html>

<head>
    <title>Advertiser Dashboard</title>

    <style>
        .unread-badge {
            display: inline-block;
            background-color: red;
            color: white;
            padding: 4px 9px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: bold;
            margin-left: 8px;
        }

        .conversation {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <h1>Advertiser Dashboard</h1>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Log Out</button>
    </form>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p>
        <a href="{{ route('advertisements.create') }}">
            Create New Advertisement
        </a>
    </p>

    <hr>

    <!-- Unread Messages -->
    <h2>
        Messages

        @if ($unreadMessages > 0)
            <span class="unread-badge">
                {{ $unreadMessages }} Unread
            </span>
        @else
            <span>
                (No unread messages)
            </span>
        @endif

    </h2>

    <hr>

    <h2>My Advertisements</h2>

    @forelse ($advertisements as $advertisement)

        <article>

            <h3>{{ $advertisement->title }}</h3>

            <p>
                <strong>Status:</strong>
                {{ ucfirst($advertisement->status) }}
            </p>

            <a href="{{ route('advertisements.edit', $advertisement) }}">
                Update Advertisement
            </a>

            <form method="POST"
                  action="{{ route('advertisements.destroy', $advertisement) }}"
                  style="display:inline;">

                @csrf
                @method('DELETE')

                <button type="submit"
                        onclick="return confirm('Are you sure you want to delete this advertisement?')">
                    Delete Advertisement
                </button>

            </form>

        </article>

        <hr>

    @empty

        <p>You have not created any advertisements yet.</p>

    @endforelse


    <h2>Conversations</h2>

    @if($messages->count() > 0)

        @foreach($messages as $message)

            @php

                $otherUserId = $message->sender_id === auth()->id()
                    ? $message->receiver_id
                    : $message->sender_id;

                $otherUser = $message->sender_id === auth()->id()
                    ? $message->receiver
                    : $message->sender;

            @endphp

            <div class="conversation">

                <p>
                    <strong>Advertisement:</strong>
                    {{ $message->advertisement->title }}
                </p>

                <p>
                    <strong>With:</strong>
                    {{ $otherUser->name }}
                </p>

                <!-- Show unread indicator for this conversation -->
                @php
                    $conversationUnread = \App\Models\Message::where(
                        'advertisement_id',
                        $message->advertisement_id
                    )
                    ->where('sender_id', $otherUserId)
                    ->where('receiver_id', auth()->id())
                    ->whereNull('read_at')
                    ->count();
                @endphp

                @if ($conversationUnread > 0)

                    <p>
                        <span class="unread-badge">
                            {{ $conversationUnread }} Unread Message{{ $conversationUnread > 1 ? 's' : '' }}
                        </span>
                    </p>

                @endif

                <p>
                    <a href="{{ route('messages.conversation', [
                        'advertisement' => $message->advertisement,
                        'other_user' => $otherUserId
                    ]) }}">
                        View Conversation
                    </a>
                </p>

            </div>

        @endforeach

    @else

        <p>No conversations yet.</p>

    @endif

</body>

</html>