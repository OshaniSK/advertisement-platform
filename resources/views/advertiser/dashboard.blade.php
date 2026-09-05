<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Advertiser Dashboard</title>

<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background: #f5f6f8;
        color: #222;
    }

    /* ================= HEADER ================= */

    .header {
        background: #ffffff;
        border-bottom: 1px solid #ddd;
        padding: 18px 40px;
    }

    .header-inner {
        max-width: 1200px;
        margin: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 24px;
        font-weight: bold;
        color: #111827;
        text-decoration: none;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .welcome {
        color: #555;
        font-size: 14px;
    }

    .logout-button {
        border: none;
        background: #ef4444;
        color: white;
        padding: 9px 16px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
    }

    .logout-button:hover {
        background: #dc2626;
    }

    /* ================= NOTIFICATION BELL ================= */

    .notification-wrapper {
        position: relative;
    }

    .notification-button {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border: 1px solid #e5e7eb;
        border-radius: 50%;
        background: #ffffff;
        cursor: pointer;
        font-size: 20px;
        transition: 0.2s;
    }

    .notification-button:hover {
        background: #f3f4f6;
    }

    .notification-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        min-width: 20px;
        height: 20px;
        padding: 2px 5px;
        border-radius: 999px;
        background: #dc2626;
        color: white;
        font-size: 11px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .notification-dropdown {
        display: none;
        position: absolute;
        top: 52px;
        right: 0;
        width: 350px;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        z-index: 1000;
        overflow: hidden;
    }

    .notification-dropdown.show {
        display: block;
    }

    .notification-header {
        padding: 15px 18px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .notification-header strong {
        color: #111827;
    }

    .notification-header a {
        color: #2563eb;
        font-size: 12px;
        text-decoration: none;
    }

    .notification-header a:hover {
        text-decoration: underline;
    }

    .notification-item {
        display: block;
        padding: 14px 18px;
        border-bottom: 1px solid #f3f4f6;
        text-decoration: none;
        color: #374151;
    }

    .notification-item:hover {
        background: #f9fafb;
    }

    .notification-item.unread {
        background: #eff6ff;
    }

    .notification-item-title {
        font-weight: bold;
        font-size: 14px;
        margin-bottom: 5px;
        color: #111827;
    }

    .notification-item-text {
        font-size: 13px;
        color: #6b7280;
        line-height: 1.4;
    }

    .notification-empty {
        padding: 25px;
        text-align: center;
        color: #6b7280;
        font-size: 14px;
    }

    .notification-footer {
        padding: 12px;
        text-align: center;
        border-top: 1px solid #e5e7eb;
    }

    .notification-footer a {
        color: #2563eb;
        text-decoration: none;
        font-size: 13px;
        font-weight: bold;
    }

    .notification-footer a:hover {
        text-decoration: underline;
    }

    /* ================= MAIN ================= */

    .container {
        max-width: 1200px;
        margin: 35px auto;
        padding: 0 20px;
    }

    .page-title {
        font-size: 32px;
        margin-bottom: 8px;
        color: #111827;
    }

    .page-subtitle {
        color: #6b7280;
        margin-bottom: 30px;
    }

    /* ================= SUCCESS ================= */

    .success {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
        padding: 14px 18px;
        border-radius: 8px;
        margin-bottom: 25px;
    }

    /* ================= STATS ================= */

    .stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 35px;
    }

    .stat-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
    }

    .stat-title {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .stat-number {
        font-size: 30px;
        font-weight: bold;
        color: #111827;
    }

    .unread-number {
        color: #dc2626;
    }

    /* ================= CREATE BUTTON ================= */

    .create-section {
        margin-bottom: 35px;
    }

    .create-button {
        display: inline-block;
        background: #111827;
        color: white;
        padding: 13px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
    }

    .create-button:hover {
        background: #374151;
    }

    /* ================= SECTION ================= */

    .section {
        background: white;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .section-title {
        margin: 0;
        font-size: 22px;
        color: #111827;
    }

    /* ================= ADVERTISEMENT GRID ================= */

    .advertisement-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .advertisement-card {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        overflow: hidden;
        background: white;
    }

    .advertisement-image-container {
        width: 100%;
        height: 190px;
        background: #f3f4f6;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .advertisement-image {
        width: 100%;
        height: 190px;
        object-fit: cover;
    }

    .no-image {
        color: #9ca3af;
        font-size: 14px;
    }

    .advertisement-content {
        padding: 18px;
    }

    .advertisement-title {
        margin: 0 0 10px;
        font-size: 18px;
        color: #111827;
    }

    .price {
        font-size: 19px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .category,
    .location {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 6px;
    }

    /* ================= STATUS ================= */

    .status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        margin-top: 8px;
    }

    .status-approved {
        background: #dcfce7;
        color: #166534;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    /* ================= BUTTONS ================= */

    .card-actions {
        display: flex;
        gap: 8px;
        margin-top: 15px;
    }

    .edit-button,
    .view-button,
    .delete-button {
        flex: 1;
        padding: 9px 10px;
        border-radius: 6px;
        text-align: center;
        font-size: 13px;
        font-weight: bold;
        cursor: pointer;
    }

    .edit-button {
        background: #2563eb;
        color: white;
        text-decoration: none;
    }

    .edit-button:hover {
        background: #1d4ed8;
    }

    .view-button {
        background: #f3f4f6;
        color: #374151;
        text-decoration: none;
    }

    .view-button:hover {
        background: #e5e7eb;
    }

    .delete-button {
        background: #fee2e2;
        color: #991b1b;
        border: none;
    }

    .delete-button:hover {
        background: #fecaca;
    }

    /* ================= CONVERSATIONS ================= */

    .conversation {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 18px;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .conversation-info h3 {
        margin: 0 0 8px;
        font-size: 17px;
    }

    .conversation-info p {
        margin: 4px 0;
        color: #6b7280;
        font-size: 14px;
    }

    .conversation-button {
        background: #111827;
        color: white;
        padding: 10px 16px;
        border-radius: 7px;
        text-decoration: none;
        font-size: 13px;
        font-weight: bold;
    }

    .conversation-button:hover {
        background: #374151;
    }

    .unread-badge {
        display: inline-block;
        background: #dc2626;
        color: white;
        padding: 4px 9px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        margin-left: 8px;
    }

    .empty {
        text-align: center;
        padding: 30px;
        color: #6b7280;
    }

    /* ================= RESPONSIVE ================= */

    @media (max-width: 900px) {

        .stats {
            grid-template-columns: 1fr;
        }

        .advertisement-grid {
            grid-template-columns: repeat(2, 1fr);
        }

    }

    @media (max-width: 650px) {

        .header {
            padding: 15px 20px;
        }

        .header-inner {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .header-right {
            width: 100%;
            justify-content: space-between;
        }

        .advertisement-grid {
            grid-template-columns: 1fr;
        }

        .conversation {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .conversation-button {
            width: 100%;
            text-align: center;
        }

        .card-actions {
            flex-direction: column;
        }

        .notification-dropdown {
            position: fixed;
            top: 75px;
            left: 20px;
            right: 20px;
            width: auto;
        }

    }
</style>
```

</head>

<body>

```
<!-- ================= HEADER ================= -->

<header class="header">

    <div class="header-inner">

        <a
            href="{{ route('advertiser.dashboard') }}"
            class="logo"
        >
            Advertisement Platform
        </a>


        <div class="header-right">

            <!-- Welcome -->

            <span class="welcome">
                Welcome, {{ auth()->user()->name }}
            </span>


            <!-- ================= NOTIFICATION BELL ================= -->

            <div class="notification-wrapper">

                <button
                    type="button"
                    class="notification-button"
                    onclick="toggleNotifications()"
                    aria-label="Notifications"
                >

                    🔔

                    @if (auth()->user()->unreadNotifications()->count() > 0)

                        <span class="notification-badge">

                            {{ auth()->user()->unreadNotifications()->count() }}

                        </span>

                    @endif

                </button>


                <!-- Notification Dropdown -->

                <div
                    id="notificationDropdown"
                    class="notification-dropdown"
                >

                    <div class="notification-header">

                        <strong>
                            Notifications
                        </strong>

                        <a href="{{ route('notifications.index') }}">
                            View All
                        </a>

                    </div>


                    @forelse (
                        auth()->user()->notifications()->latest()->take(5)->get()
                        as $notification
                    )

                        <a
                            href="{{ route('notifications.index') }}"
                            class="notification-item {{ $notification->read_at === null ? 'unread' : '' }}"
                        >

                            <div class="notification-item-title">

                                {{ $notification->data['sender_name'] ?? 'New Message' }}

                            </div>


                            <div class="notification-item-text">

                                {{ \Illuminate\Support\Str::limit(
                                    $notification->data['message'] ?? 'You have a new notification.',
                                    70
                                ) }}

                            </div>

                        </a>

                    @empty

                        <div class="notification-empty">

                            No notifications yet.

                        </div>

                    @endforelse


                    <div class="notification-footer">

                        <a href="{{ route('notifications.index') }}">
                            View All Notifications
                        </a>

                    </div>

                </div>

            </div>


            <!-- ================= LOGOUT ================= -->

            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >
                    Log Out
                </button>

            </form>

        </div>

    </div>

</header>


<!-- ================= MAIN ================= -->

<main class="container">

    <h1 class="page-title">
        Advertiser Dashboard
    </h1>

    <p class="page-subtitle">
        Manage your advertisements and conversations.
    </p>


    <!-- ================= SUCCESS MESSAGE ================= -->

    @if (session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    <!-- ================= STATISTICS ================= -->

    <div class="stats">

        <div class="stat-card">

            <div class="stat-title">
                My Advertisements
            </div>

            <div class="stat-number">
                {{ $advertisements->count() }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Conversations
            </div>

            <div class="stat-number">
                {{ $messages->count() }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Unread Messages
            </div>

            <div class="stat-number unread-number">
                {{ $unreadMessages }}
            </div>

        </div>

    </div>


    <!-- ================= CREATE ADVERTISEMENT ================= -->

    <div class="create-section">

        <a
            href="{{ route('advertisements.create') }}"
            class="create-button"
        >
            + Create New Advertisement
        </a>

    </div>


    <!-- ================= MY ADVERTISEMENTS ================= -->

    <section class="section">

        <div class="section-header">

            <h2 class="section-title">
                My Advertisements
            </h2>

        </div>


        @if ($advertisements->count() > 0)

            <div class="advertisement-grid">

                @foreach ($advertisements as $advertisement)

                    <article class="advertisement-card">

                        <!-- Image -->

                        <div class="advertisement-image-container">

                            @if ($advertisement->image)

                                <img
                                    src="{{ asset('storage/' . $advertisement->image) }}"
                                    alt="{{ $advertisement->title }}"
                                    class="advertisement-image"
                                >

                            @else

                                <span class="no-image">
                                    No Image
                                </span>

                            @endif

                        </div>


                        <!-- Content -->

                        <div class="advertisement-content">

                            <h3 class="advertisement-title">
                                {{ $advertisement->title }}
                            </h3>


                            @if ($advertisement->price !== null)

                                <div class="price">
                                    Rs. {{ number_format($advertisement->price, 2) }}
                                </div>

                            @else

                                <div class="price">
                                    Price not specified
                                </div>

                            @endif


                            @if ($advertisement->category)

                                <div class="category">

                                    Category:
                                    {{ $advertisement->category }}

                                </div>

                            @endif


                            @if ($advertisement->location)

                                <div class="location">

                                    📍 {{ $advertisement->location }}

                                </div>

                            @endif


                            <!-- Status -->

                            @if ($advertisement->status === 'approved')

                                <span class="status status-approved">
                                    Approved
                                </span>

                            @elseif ($advertisement->status === 'pending')

                                <span class="status status-pending">
                                    Pending
                                </span>

                            @elseif ($advertisement->status === 'rejected')

                                <span class="status status-rejected">
                                    Rejected
                                </span>

                            @else

                                <span class="status">
                                    {{ ucfirst($advertisement->status) }}
                                </span>

                            @endif


                            <!-- Buttons -->

                            <div class="card-actions">

                                <a
                                    href="{{ route('advertisements.edit', $advertisement) }}"
                                    class="edit-button"
                                >
                                    Edit
                                </a>


                                @if ($advertisement->status === 'approved')

                                    <a
                                        href="{{ route('advertisements.show', $advertisement) }}"
                                        class="view-button"
                                    >
                                        View
                                    </a>

                                @endif


                                <form
                                    method="POST"
                                    action="{{ route('advertisements.destroy', $advertisement) }}"
                                    style="flex: 1;"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="delete-button"
                                        style="width: 100%;"
                                        onclick="return confirm('Are you sure you want to delete this advertisement?')"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            <div class="empty">

                <p>
                    You have not created any advertisements yet.
                </p>

                <a
                    href="{{ route('advertisements.create') }}"
                    class="create-button"
                >
                    Create Your First Advertisement
                </a>

            </div>

        @endif

    </section>


    <!-- ================= CONVERSATIONS ================= -->

    <section class="section">

        <div class="section-header">

            <h2 class="section-title">

                Messages

                @if ($unreadMessages > 0)

                    <span class="unread-badge">
                        {{ $unreadMessages }} Unread
                    </span>

                @endif

            </h2>

        </div>


        @if ($messages->count() > 0)

            @foreach ($messages as $message)

                @php

                    $otherUserId =
                        $message->sender_id === auth()->id()
                        ? $message->receiver_id
                        : $message->sender_id;

                    $otherUser =
                        $message->sender_id === auth()->id()
                        ? $message->receiver
                        : $message->sender;

                @endphp


                <div class="conversation">

                    <div class="conversation-info">

                        <h3>

                            {{ $otherUser->name }}


                            @if (
                                $message->receiver_id === auth()->id()
                                && $message->read_at === null
                            )

                                <span class="unread-badge">
                                    New
                                </span>

                            @endif

                        </h3>


                        <p>

                            <strong>
                                Advertisement:
                            </strong>

                            {{ $message->advertisement->title }}

                        </p>


                        <p>

                            Last message:

                            {{ \Illuminate\Support\Str::limit(
                                $message->message,
                                80
                            ) }}

                        </p>

                    </div>


                    <a
                        href="{{ route('messages.conversation', [
                            'advertisement' => $message->advertisement,
                            'other_user' => $otherUserId
                        ]) }}"
                        class="conversation-button"
                    >
                        View Conversation
                    </a>

                </div>

            @endforeach

        @else

            <div class="empty">

                <p>
                    No conversations yet.
                </p>

            </div>

        @endif

    </section>

</main>


<!-- ================= NOTIFICATION JAVASCRIPT ================= -->

<script>

    function toggleNotifications() {

        const dropdown =
            document.getElementById('notificationDropdown');

        dropdown.classList.toggle('show');

    }


    document.addEventListener('click', function(event) {

        const wrapper =
            document.querySelector('.notification-wrapper');

        const dropdown =
            document.getElementById('notificationDropdown');

        if (
            wrapper &&
            dropdown &&
            !wrapper.contains(event.target)
        ) {

            dropdown.classList.remove('show');

        }

    });

</script>
```

</body>

</html>
