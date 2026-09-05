<!DOCTYPE html>

<html lang="en">

<head>

```
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
    Chat - {{ $advertisement->title }}
</title>

<style>

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background: #eef1f5;
        color: #111827;
    }

    /* ================= PAGE ================= */

    .page {
        min-height: 100vh;
        padding: 30px 20px;
    }

    .chat-container {
        max-width: 850px;
        height: calc(100vh - 60px);
        min-height: 600px;
        margin: auto;
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 35px rgba(0, 0, 0, 0.10);
        display: flex;
        flex-direction: column;
    }

    /* ================= HEADER ================= */

    .chat-header {
        background: #111827;
        color: white;
        padding: 18px 24px;
    }

    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .header-user {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .avatar {
        width: 45px;
        height: 45px;
        min-width: 45px;
        border-radius: 50%;
        background: #2563eb;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 18px;
        text-transform: uppercase;
    }

    .header-information {
        min-width: 0;
    }

    .chat-with {
        margin: 0 0 4px;
        font-size: 16px;
        font-weight: bold;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .advertisement-title {
        margin: 0;
        color: #d1d5db;
        font-size: 13px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 500px;
    }

    .advertisement-link {
        color: white;
        text-decoration: none;
        font-size: 13px;
        border: 1px solid #6b7280;
        padding: 9px 13px;
        border-radius: 7px;
        white-space: nowrap;
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

    /* ================= CHAT AREA ================= */

    .messages {
        flex: 1;
        overflow-y: auto;
        padding: 25px;
        background: #f8fafc;
        scroll-behavior: smooth;
    }

    /* Scrollbar */

    .messages::-webkit-scrollbar {
        width: 7px;
    }

    .messages::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    .messages::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .messages::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* ================= EMPTY CHAT ================= */

    .empty-chat {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: #9ca3af;
    }

    .empty-icon {
        width: 60px;
        height: 60px;
        margin: auto auto 15px;
        border-radius: 50%;
        background: #e5e7eb;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 28px;
    }

    .empty-chat p {
        margin: 6px 0;
    }

    .empty-title {
        color: #374151;
        font-weight: bold;
    }

    /* ================= MESSAGE ================= */

    .message {
        display: flex;
        margin-bottom: 18px;
        width: 100%;
    }

    .message.sent {
        justify-content: flex-end;
    }

    .message.received {
        justify-content: flex-start;
    }

    .message-content {
        max-width: 72%;
    }

    .bubble {
        padding: 12px 16px;
        border-radius: 17px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.06);
    }

    /* Sent */

    .sent .bubble {
        background: #2563eb;
        color: white;
        border-bottom-right-radius: 5px;
    }

    /* Received */

    .received .bubble {
        background: white;
        color: #111827;
        border: 1px solid #e5e7eb;
        border-bottom-left-radius: 5px;
    }

    /* ================= SENDER ================= */

    .sender {
        font-size: 11px;
        font-weight: bold;
        margin-bottom: 6px;
    }

    .sent .sender {
        color: #dbeafe;
    }

    .received .sender {
        color: #374151;
    }

    /* ================= MESSAGE TEXT ================= */

    .message-text {
        margin: 0;
        line-height: 1.5;
        font-size: 14px;
        white-space: pre-wrap;
        word-break: break-word;
    }

    /* ================= TIME ================= */

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
        border-radius: 12px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
        resize: vertical;
        outline: none;
        transition: 0.2s;
    }

    .message-input textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
    }

    .send-button {
        border: none;
        background: #2563eb;
        color: white;
        padding: 13px 21px;
        border-radius: 10px;
        font-weight: bold;
        cursor: pointer;
        white-space: nowrap;
        transition: 0.2s;
    }

    .send-button:hover {
        background: #1d4ed8;
    }

    .send-button:active {
        transform: scale(0.98);
    }

    /* ================= BACK LINK ================= */

    .back-link-container {
        max-width: 850px;
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
            padding: 15px;
        }

        .header-top {
            align-items: center;
        }

        .avatar {
            width: 40px;
            height: 40px;
            min-width: 40px;
            font-size: 16px;
        }

        .chat-with {
            font-size: 15px;
        }

        .advertisement-title {
            font-size: 12px;
            max-width: 210px;
        }

        .advertisement-link {
            display: none;
        }

        .messages {
            padding: 18px 12px;
        }

        .message-content {
            max-width: 82%;
        }

        .bubble {
            padding: 11px 14px;
        }

        .message-text {
            font-size: 14px;
        }

        .message-form {
            padding: 10px;
        }

        .message-form form {
            gap: 7px;
        }

        .message-input textarea {
            min-height: 48px;
            padding: 11px 12px;
        }

        .send-button {
            padding: 11px 15px;
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

            <div class="header-user">


                <!-- Avatar -->

                <div class="avatar">

                    {{ strtoupper(substr($other_user->name, 0, 1)) }}

                </div>


                <!-- User Information -->

                <div class="header-information">

                    <p class="chat-with">

                        {{ $other_user->name }}

                    </p>

                    <p class="advertisement-title">

                        {{ $advertisement->title }}

                    </p>

                </div>

            </div>


            <!-- Advertisement -->

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

                <p>
                    {{ $error }}
                </p>

            @endforeach

        </div>

    @endif


    <!-- ================= CHAT MESSAGES ================= -->

    <div
        class="messages"
        id="messages"
    >

        @if ($messages->count() > 0)


            @foreach ($messages as $message)


                @if ($message->sender_id === auth()->id())


                    <!-- ================= SENT MESSAGE ================= -->

                    <div class="message sent">

                        <div class="message-content">

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

                    </div>


                @else


                    <!-- ================= RECEIVED MESSAGE ================= -->

                    <div class="message received">

                        <div class="message-content">

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

                    </div>


                @endif


            @endforeach


        @else


            <!-- ================= EMPTY CHAT ================= -->

            <div class="empty-chat">

                <div>

                    <div class="empty-icon">
                        💬
                    </div>

                    <p class="empty-title">
                        No messages yet
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
                    id="message"
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

<!-- ================= JAVASCRIPT ================= -->

<script>

    /*
     * Automatically scroll to the newest message
     */

    const messagesContainer =
        document.getElementById('messages');

    if (messagesContainer) {

        messagesContainer.scrollTop =
            messagesContainer.scrollHeight;

    }


    /*
     * Press Enter to send.
     *
     * Shift + Enter creates a new line.
     */

    const messageInput =
        document.getElementById('message');

    if (messageInput) {

        messageInput.addEventListener('keydown', function(event) {

            if (
                event.key === 'Enter' &&
                !event.shiftKey
            ) {

                event.preventDefault();

                this.closest('form').submit();

            }

        });

    }

</script>

</body>

</html>
