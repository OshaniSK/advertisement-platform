<!DOCTYPE html>

<html lang="en">

<head>

```
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Messages</title>

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

    .header {
        background: white;
        border-bottom: 1px solid #e5e7eb;
        padding: 18px 30px;
    }

    .header-inner {
        max-width: 1000px;
        margin: auto;

        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 21px;
        font-weight: bold;
        color: #111827;
        text-decoration: none;
    }

    .back-link {
        color: #2563eb;
        text-decoration: none;
        font-size: 14px;
    }

    .container {
        max-width: 1000px;
        margin: 35px auto;
        padding: 0 15px;
    }

    .page-title {
        margin-bottom: 20px;
    }

    .page-title h1 {
        margin: 0;
        font-size: 28px;
    }

    .page-title p {
        margin-top: 7px;
        color: #6b7280;
    }

    .messages-box {
        background: white;
        border-radius: 12px;
        overflow: hidden;

        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.07);
    }

    .conversation {
        display: flex;
        align-items: center;

        padding: 20px;

        border-bottom: 1px solid #e5e7eb;

        text-decoration: none;
        color: inherit;

        transition: background 0.2s;
    }

    .conversation:last-child {
        border-bottom: none;
    }

    .conversation:hover {
        background: #f9fafb;
    }

    .avatar {
        width: 50px;
        height: 50px;

        border-radius: 50%;

        background: #2563eb;
        color: white;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 19px;
        font-weight: bold;

        margin-right: 15px;

        flex-shrink: 0;
    }

    .conversation-content {
        flex: 1;
        min-width: 0;
    }

    .conversation-top {
        display: flex;
        justify-content: space-between;
        gap: 15px;
    }

    .person-name {
        font-size: 16px;
        font-weight: bold;
    }

    .date {
        font-size: 12px;
        color: #9ca3af;
        white-space: nowrap;
    }

    .advertisement-title {
        margin-top: 5px;

        color: #2563eb;

        font-size: 14px;
        font-weight: 600;
    }

    .last-message {
        margin-top: 6px;

        color: #6b7280;

        font-size: 14px;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;

        max-width: 700px;
    }

    .arrow {
        font-size: 22px;
        color: #9ca3af;
        margin-left: 15px;
    }

    .empty {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-icon {
        font-size: 45px;
        margin-bottom: 15px;
    }

    .empty h2 {
        margin: 0 0 8px;
    }

    .empty p {
        color: #6b7280;
    }

    .browse-button {
        display: inline-block;

        margin-top: 15px;

        background: #2563eb;
        color: white;

        padding: 10px 18px;

        border-radius: 7px;

        text-decoration: none;
    }

    @media (max-width: 600px) {

        .header {
            padding: 15px;
        }

        .container {
            margin-top: 20px;
        }

        .page-title h1 {
            font-size: 24px;
        }

        .conversation {
            padding: 15px;
        }

        .avatar {
            width: 43px;
            height: 43px;
            font-size: 16px;
        }

        .last-message {
            max-width: 200px;
        }

        .date {
            display: none;
        }

    }

</style>
```

</head>

<body>

<header class="header">

```
<div class="header-inner">

    <a
        href="{{ route('home') }}"
        class="logo"
    >
        Advertisement Platform
    </a>


    @if(auth()->user()->role === 'advertiser')

        <a
            href="{{ route('advertiser.dashboard') }}"
            class="back-link"
        >
            ← Dashboard
        </a>

    @elseif(auth()->user()->role === 'visitor')

        <a
            href="{{ route('visitor.dashboard') }}"
            class="back-link"
        >
            ← Dashboard
        </a>

    @else

        <a
            href="{{ route('advertisements.index') }}"
            class="back-link"
        >
            ← Advertisements
        </a>

    @endif

</div>
```

</header>

<main class="container">

```
<div class="page-title">

    <h1>
        My Messages
    </h1>

    <p>
        Your conversations with buyers and sellers.
    </p>

</div>


<div class="messages-box">


    @if ($messages->count() > 0)


        @foreach ($messages as $message)

            @php

                $otherUser = (int) $message->sender_id === (int) auth()->id()
                    ? $message->receiver
                    : $message->sender;

                $initial = strtoupper(
                    substr($otherUser->name ?? 'U', 0, 1)
                );

            @endphp


            <a
                href="{{ route('messages.conversation', [
                    'advertisement' => $message->advertisement_id,
                    'other_user' => $otherUser->id
                ]) }}"
                class="conversation"
            >


                <!-- USER AVATAR -->

                <div class="avatar">

                    {{ $initial }}

                </div>


                <!-- CONVERSATION CONTENT -->

                <div class="conversation-content">


                    <div class="conversation-top">

                        <span class="person-name">

                            {{ $otherUser->name }}

                        </span>


                        <span class="date">

                            {{ $message->created_at->format('d M Y, h:i A') }}

                        </span>

                    </div>


                    <div class="advertisement-title">

                        {{ $message->advertisement->title }}

                    </div>


                    <div class="last-message">

                        {{ $message->message }}

                    </div>


                </div>


                <div class="arrow">

                    ›

                </div>


            </a>


        @endforeach


    @else


        <div class="empty">

            <div class="empty-icon">
                💬
            </div>

            <h2>
                No messages yet
            </h2>

            <p>
                Your conversations will appear here.
            </p>


            <a
                href="{{ route('advertisements.index') }}"
                class="browse-button"
            >
                Browse Advertisements
            </a>

        </div>


    @endif


</div>
```

</main>

</body>

</html>
