<!DOCTYPE html>
<html>

<head>
    <title>Chat - {{ $advertisement->title }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .chat-container {
            max-width: 700px;
            margin: auto;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
        }

        .chat-header {
            padding: 20px;
            background-color: #333;
            color: white;
        }

        .chat-header h1 {
            margin: 0 0 5px 0;
            font-size: 22px;
        }

        .chat-header p {
            margin: 0;
        }

        .messages {
            padding: 20px;
            min-height: 400px;
        }

        .message {
            margin-bottom: 15px;
            display: flex;
        }

        .message.sent {
            justify-content: flex-end;
        }

        .message.received {
            justify-content: flex-start;
        }

        .bubble {
            max-width: 65%;
            padding: 12px 15px;
            border-radius: 15px;
        }

        .sent .bubble {
            background-color: #d1e7ff;
            border-bottom-right-radius: 3px;
        }

        .received .bubble {
            background-color: #eeeeee;
            border-bottom-left-radius: 3px;
        }

        .sender {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .message-text {
            margin: 0 0 7px 0;
            word-wrap: break-word;
        }

        .time {
            font-size: 11px;
            color: #666;
        }

        .message-form {
            border-top: 1px solid #ddd;
            padding: 15px;
        }

        .message-form textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            resize: vertical;
        }

        .message-form button {
            margin-top: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            background-color: #333;
            color: white;
            cursor: pointer;
        }

        .message-form button:hover {
            background-color: #555;
        }

        .success {
            margin: 15px;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
        }

        .error {
            margin: 15px;
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 5px;
        }

        .back-link {
            display: block;
            margin: 20px auto;
            max-width: 700px;
        }
    </style>
</head>

<body>

    <div class="chat-container">

        <div class="chat-header">

            <h1>{{ $advertisement->title }}</h1>

            <p>
                Chat with {{ $other_user->name }}
            </p>

        </div>

        @if (session('success'))

            <div class="success">
                {{ session('success') }}
            </div>

        @endif

        @if ($errors->any())

            <div class="error">

                @foreach ($errors->all() as $error)

                    <p>{{ $error }}</p>

                @endforeach

            </div>

        @endif

        <div class="messages">

            @foreach ($messages as $message)

                @if ($message->sender_id === auth()->id())

                    {{-- Message sent by logged-in user --}}

                    <div class="message sent">

                        <div class="bubble">

                            <div class="sender">
                                You
                            </div>

                            <p class="message-text">
                                {{ $message->message }}
                            </p>

                            <div class="time">
                                {{ $message->created_at->format('Y-m-d H:i') }}
                            </div>

                        </div>

                    </div>

                @else

                    {{-- Message received from other user --}}

                    <div class="message received">

                        <div class="bubble">

                            <div class="sender">
                                {{ $message->sender->name }}
                            </div>

                            <p class="message-text">
                                {{ $message->message }}
                            </p>

                            <div class="time">
                                {{ $message->created_at->format('Y-m-d H:i') }}
                            </div>

                        </div>

                    </div>

                @endif

            @endforeach

        </div>

        <div class="message-form">

            <form method="POST"
                  action="{{ route('messages.send', [
                      'advertisement' => $advertisement,
                      'other_user' => $other_user
                  ]) }}">

                @csrf

                <textarea
                    name="message"
                    rows="3"
                    placeholder="Type your message..."
                    required
                ></textarea>

                <button type="submit">
                    Send Message
                </button>

            </form>

        </div>

    </div>

    <a class="back-link"
       href="{{ route('messages.inbox') }}">
        ← Back to Messages
    </a>

</body>

</html>