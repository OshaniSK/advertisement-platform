<!DOCTYPE html>
<html>

<head>
    <title>My Messages</title>
</head>

<body>

    <h1>My Messages</h1>

    <br>

@if(auth()->user()->role === 'advertiser')

    <a href="{{ route('advertiser.dashboard') }}">
        Back to Advertiser Dashboard
    </a>

@else

    <a href="{{ route('advertisements.index') }}">
        Back to Advertisements
    </a>

@endif

    <hr>

    @if ($messages->count() > 0)

        @foreach ($messages as $message)

            @php
                $otherUser = $message->sender_id === auth()->id()
                    ? $message->receiver
                    : $message->sender;
            @endphp

            <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px;">

                <h3>
                    {{ $message->advertisement->title }}
                </h3>

                <p>
                    <strong>Chat with:</strong>
                    {{ $otherUser->name }}
                </p>

                <p>
                    <strong>Last message:</strong>
                    {{ $message->message }}
                </p>

                <p>
                    <small>
                        {{ $message->created_at->format('Y-m-d H:i') }}
                    </small>
                </p>

                <a href="{{ route('messages.conversation', [
                    'advertisement' => $message->advertisement,
                    'other_user' => $otherUser
                ]) }}">
                    Open Conversation
                </a>

            </div>

        @endforeach

    @else

        <p>No messages yet.</p>

    @endif

</body>

</html>