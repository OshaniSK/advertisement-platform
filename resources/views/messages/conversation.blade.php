<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Chat - {{ $advertisement->title }}</title>

<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background: #f3f4f6;
        color: #111827;
    }

    /* ================= PAGE ================= */

    .page {
        min-height: 100vh;
        padding: 30px 20px;
    }

    .chat-container {
        max-width: 800px;
        height: calc(100vh - 60px);
        min-height: 600px;
        margin: auto;
        background: white;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
    }

    /* ================= HEADER ================= */

    .chat-header {
        background: #111827;
        color: white;
        padding: 20px 25px;
    }

    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
    }

    .advertisement-title {
        margin: 0;
        font-size: 21px;
        font-weight: bold;
    }

    .chat-with {
        margin: 7px 0 0;
        color: #d1d5db;
        font-size: 14px;
    }

    .chat-with strong {
        color: white;
    }

    .advertisement-link {
        color: white;
        text-decoration: none;
        font-size: 13px;
        border: 1px solid #6b7280;
        padding: 8px 12px;
        border-radius: 6px;
    }

    .advertisement-link:hover {
        background: #374151;
    }

    /* ================= ALERTS ================= */

    .success {
        margin: 15px 20px 0;
        padding: 12px 15px;
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
        border-radius: 8px;
        font-size: 14px;
    }

    .error {
        margin: 15px 20px 0;
        padding: 12px 15px;
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
        border-radius: 8px;
        font-size: 14px;
    }

    .error p {
        margin: 3px 0;
    }

    /* ================= MESSAGES ================= */

    .messages {
        flex: 1;
        overflow-y: auto;
        padding: 25px;
        background: #f9fafb;
    }

    .empty-chat {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: #9ca3af;
    }

    .message {
        display: flex;
        margin-bottom: 18px;
    }

    .message.sent {
        justify-content: flex-end;
    }

    .message.received {
        justify-content: flex-start;
    }

    .bubble {
        max-width: 70%;
        padding: 12px 16px;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    }

    .sent .bubble {
        background: #2563eb;
        color: white;
        border-bottom-right-radius: 4px;
    }

    .received .bubble {
        background: white;
        color: #111827;
        border: 1px solid #e5e7eb;
        border-bottom-left-radius: 4px;
    }

    .sender {
        font-size: 12px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .sent .sender {
        color: #dbeafe;
    }

    .received .sender {
        color: #374151;
    }

    .message-text {
        margin: 0;
        line-height: 1.5;
        white-space: pre-wrap;
        word-break: break-word;
    }

    .time {
        margin-top: 7px;
        font-size: 10px;
    }

    .sent .time {
        color: #dbeafe;
        text-align: right;
    }

    .received .time {
        color: #9ca3af;
    }

    /* ================= MESSAGE FORM ================= */

    .message-form {
        background: white;
        border-top: 1px solid #e5e7eb;
        padding: 15px 20px;
    }

    .message-form form {
        display: flex;
        gap: 10px;
        align-items: flex-end;
    }

    .message-input {
        flex: 1;
    }

    .message-input textarea {
        width: 100%;
        min-height: 50px;
        max-height: 140px;
        padding: 13px 15px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
        resize: vertical;
        outline: none;
    }

    .message-input textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
    }

    .send-button {
        border: none;
        background: #2563eb;
        color: white;
        padding: 13px 20px;
        border-radius: 9px;
        font-weight: bold;
        cursor: pointer;
        white-space: nowrap;
    }

    .send-button:hover {
        background: #1d4ed8;
    }

    /* ================= BACK LINK ================= */

    .back-link-container {
        max-width: 800px;
        margin: 15px auto 0;
    }

    .back-link {
        color: #374151;
        text-decoration: none;
        font-size: 14px;
        font-weight: bold;
    }

    .back-link:hover {
        color: #2563eb;
    }

    /* ================= RESPONSIVE ================= */

    @media (max-width: 650px) {

        .page {
            padding: 0;
        }

        .chat-container {
            height: 100vh;
            min-height: 100vh;
            border-radius: 0;
        }

        .chat-header {
            padding: 18px;
        }

        .header-top {
            align-items: flex-start;
        }

        .advertisement-title {
            font-size: 18px;
        }

        .advertisement-link {
            display: none;
        }

        .messages {
            padding: 18px 12px;
        }

        .bubble {
            max-width: 82%;
        }

        .message-form {
            padding: 12px;
        }

        .message-form form {
            align-items: stretch;
        }

        .send-button {
            padding: 10px 15px;
        }

        .back-link-container {
            display: none;
        }
    }
</style>
```

</head>

<body>

<div class="page">

```
<div class="chat-container">

    <!-- ================= CHAT HEADER ================= -->

    <div class="chat-header">

        <div class="header-top">

            <div>

                <h1 class="advertisement-title">
                    {{ $advertisement->title }}
                </h1>

                <p class="chat-with">
                    Chat with
                    <strong>{{ $other_user->name }}</strong>
                </p>

            </div>

            <a
                href="{{ route('advertisements.show', $advertisement) }}"
                class="advertisement-link"
            >
                View Advertisement
            </a>

        </div>

    </div>


    <!-- ================= SUCCESS MESSAGE ================= -->

    @if (session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    <!-- ================= ERROR MESSAGE ================= -->

    @if ($errors->any())

        <div class="error">

            @foreach ($errors->all() as $error)

                <p>{{ $error }}</p>

            @endforeach

        </div>

    @endif


    <!-- ================= CHAT MESSAGES ================= -->

    <div class="messages" id="messages">

        @if ($messages->count() > 0)

            @foreach ($messages as $message)

                @if ($message->sender_id === auth()->id())

                    <!-- Message sent by logged-in user -->

                    <div class="message sent">

                        <div class="bubble">

                            <div class="sender">
                                You
                            </div>

                            <p class="message-text">
                                {{ $message->message }}
                            </p>

                            <div class="time">
                                {{ $message->created_at->format('M d, Y • h:i A') }}
                            </div>

                        </div>

                    </div>

                @else

                    <!-- Message received from other user -->

                    <div class="message received">

                        <div class="bubble">

                            <div class="sender">
                                {{ $message->sender->name }}
                            </div>

                            <p class="message-text">
                                {{ $message->message }}
                            </p>

                            <div class="time">
                                {{ $message->created_at->format('M d, Y • h:i A') }}
                            </div>

                        </div>

                    </div>

                @endif

            @endforeach

        @else

            <div class="empty-chat">

                <div>

                    <p>
                        No messages yet.
                    </p>

                    <p>
                        Start the conversation below.
                    </p>

                </div>

            </div>

        @endif

    </div>


    <!-- ================= MESSAGE INPUT ================= -->

    <div class="message-form">

        <form
            method="POST"
            action="{{ route('messages.send', [
                'advertisement' => $advertisement->id,
                'other_user' => $other_user->id
            ]) }}"
        >

            @csrf

            <div class="message-input">

                <textarea
                    name="message"
                    rows="2"
                    maxlength="2000"
                    placeholder="Type your message..."
                    required
                ></textarea>

            </div>

            <button
                type="submit"
                class="send-button"
            >
                Send
            </button>

        </form>

    </div>

</div>


<!-- ================= BACK TO MESSAGES ================= -->

<div class="back-link-container">

    <a
        href="{{ route('messages.inbox') }}"
        class="back-link"
    >
        ← Back to Messages
    </a>

</div>
```

</div>

<!-- ================= AUTO SCROLL ================= -->

<script>

    const messagesContainer = document.getElementById('messages');

    if (messagesContainer) {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

</script>

</body>

</html>
