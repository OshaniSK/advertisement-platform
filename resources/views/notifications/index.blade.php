```blade
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Notifications</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f6f8;
            color: #111827;
        }

        /* ================= HEADER ================= */

        .header {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 18px 40px;
        }

        .header-inner {
            max-width: 1000px;
            margin: auto;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            color: #111827;
            text-decoration: none;
        }

        .header-links {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-link {
            color: #374151;
            text-decoration: none;
            font-size: 14px;
        }

        .header-link:hover {
            color: #2563eb;
        }

        /* ================= MAIN ================= */

        .container {
            max-width: 1000px;
            margin: 35px auto;
            padding: 0 20px;
        }

        /* ================= PAGE HEADER ================= */

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 15px;
        }

        .page-title {
            margin: 0;
            font-size: 30px;
            color: #111827;
        }

        .page-subtitle {
            margin: 7px 0 0;
            color: #6b7280;
            font-size: 14px;
        }

        /* ================= BUTTON ================= */

        .button {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .back-button {
            background: #f3f4f6;
            color: #374151;
        }

        .back-button:hover {
            background: #e5e7eb;
        }

        .read-all-button {
            background: #2563eb;
            color: white;
        }

        .read-all-button:hover {
            background: #1d4ed8;
        }

        /* ================= ALERTS ================= */

        .success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* ================= NOTIFICATION CARD ================= */

        .notifications-box {
            background: white;
            border-radius: 12px;
            overflow: hidden;

            box-shadow:
                0 3px 15px rgba(0, 0, 0, 0.06);
        }

        .notification {
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;

            display: flex;
            justify-content: space-between;
            align-items: flex-start;

            gap: 20px;

            transition: background 0.2s;
        }

        .notification:last-child {
            border-bottom: none;
        }

        .notification:hover {
            background: #f9fafb;
        }

        /* ================= UNREAD ================= */

        .notification.unread {
            background: #eff6ff;
        }

        .notification.unread:hover {
            background: #dbeafe;
        }

        /* ================= ICON ================= */

        .notification-icon {
            width: 42px;
            height: 42px;

            border-radius: 50%;

            background: #dbeafe;
            color: #2563eb;

            display: flex;
            justify-content: center;
            align-items: center;

            font-size: 20px;

            flex-shrink: 0;
        }

        .notification.unread .notification-icon {
            background: #2563eb;
            color: white;
        }

        /* ================= CONTENT ================= */

        .notification-content {
            flex: 1;
        }

        .notification-title {
            margin: 0 0 7px;

            font-size: 16px;
            font-weight: bold;

            color: #111827;
        }

        .notification-message {
            margin: 0 0 8px;

            color: #4b5563;

            font-size: 14px;

            line-height: 1.5;
        }

        .notification-time {
            color: #9ca3af;
            font-size: 12px;
        }

        /* ================= STATUS ================= */

        .notification-status {
            margin-top: 2px;

            padding: 4px 9px;

            border-radius: 20px;

            font-size: 11px;
            font-weight: bold;
        }

        .status-unread {
            background: #dc2626;
            color: white;
        }

        .status-read {
            background: #e5e7eb;
            color: #6b7280;
        }

        /* ================= ACTIONS ================= */

        .notification-actions {
            display: flex;
            flex-direction: column;
            gap: 8px;

            align-items: flex-end;
        }

        .open-button {
            background: #111827;
            color: white;
        }

        .open-button:hover {
            background: #374151;
        }

        .mark-read-button {
            background: #f3f4f6;
            color: #374151;
        }

        .mark-read-button:hover {
            background: #e5e7eb;
        }

        /* ================= EMPTY ================= */

        .empty {
            background: white;

            padding: 60px 20px;

            border-radius: 12px;

            text-align: center;

            box-shadow:
                0 3px 15px rgba(0, 0, 0, 0.06);
        }

        .empty-icon {
            font-size: 45px;
            margin-bottom: 15px;
        }

        .empty h3 {
            margin: 0 0 8px;
            font-size: 20px;
        }

        .empty p {
            margin: 0;
            color: #6b7280;
        }

        /* ================= PAGINATION ================= */

        .pagination {
            margin-top: 25px;

            display: flex;
            justify-content: center;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 700px) {

            .header {
                padding: 15px 20px;
            }

            .header-inner {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .container {
                margin-top: 25px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .notification {
                flex-direction: column;
            }

            .notification-actions {
                width: 100%;
                flex-direction: row;
                align-items: center;
            }

            .notification-actions .button {
                flex: 1;
                text-align: center;
            }

        }

    </style>

</head>


<body>


<!-- ================= HEADER ================= -->

<header class="header">

    <div class="header-inner">

        <a
            href="{{ route('home') }}"
            class="logo"
        >
            Advertisement Platform
        </a>


        <div class="header-links">

            @if (auth()->user()->role === 'advertiser')

                <a
                    href="{{ route('advertiser.dashboard') }}"
                    class="header-link"
                >
                    Dashboard
                </a>

            @elseif (auth()->user()->role === 'visitor')

                <a
                    href="{{ route('visitor.dashboard') }}"
                    class="header-link"
                >
                    Dashboard
                </a>

            @elseif (auth()->user()->role === 'admin')

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="header-link"
                >
                    Dashboard
                </a>

            @endif

        </div>

    </div>

</header>


<!-- ================= MAIN ================= -->

<main class="container">


    <!-- PAGE HEADER -->

    <div class="page-header">

        <div>

            <h1 class="page-title">
                Notifications
            </h1>

            <p class="page-subtitle">
                Stay updated with your latest activity.
            </p>

        </div>


        @if (auth()->user()->unreadNotifications()->count() > 0)

            <form
                method="POST"
                action="{{ route('notifications.readAll') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="button read-all-button"
                >
                    ✓ Mark All as Read
                </button>

            </form>

        @endif

    </div>


    <!-- ================= SUCCESS ================= -->

    @if (session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    <!-- ================= ERROR ================= -->

    @if (session('error'))

        <div class="error">
            {{ session('error') }}
        </div>

    @endif


    <!-- ================= NOTIFICATIONS ================= -->

    @if ($notifications->count() > 0)

        <div class="notifications-box">


            @foreach ($notifications as $notification)

                <div
                    class="notification
                    {{ $notification->read_at === null ? 'unread' : '' }}"
                >


                    <!-- ICON -->

                    <div class="notification-icon">
                        🔔
                    </div>


                    <!-- CONTENT -->

                    <div class="notification-content">

                        <h3 class="notification-title">

                            {{ $notification->data['sender_name'] ?? 'New Notification' }}

                        </h3>


                        <p class="notification-message">

                            {{ $notification->data['message'] ?? 'You have a new notification.' }}

                        </p>


                        <div class="notification-time">

                            {{ $notification->created_at->format('M d, Y • h:i A') }}

                        </div>

                    </div>


                    <!-- STATUS + ACTIONS -->

                    <div class="notification-actions">


                        @if ($notification->read_at === null)

                            <span class="notification-status status-unread">
                                Unread
                            </span>

                        @else

                            <span class="notification-status status-read">
                                Read
                            </span>

                        @endif


                        @if (
                            isset($notification->data['advertisement_id']) &&
                            isset($notification->data['sender_id'])
                        )

                            <a
                                href="{{ route('notifications.open', $notification->id) }}"
                                class="button open-button"
                            >
                                Open
                            </a>

                        @endif


                        @if ($notification->read_at === null)

                            <form
                                method="POST"
                                action="{{ route('notifications.read', $notification->id) }}"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="button mark-read-button"
                                >
                                    Mark Read
                                </button>

                            </form>

                        @endif

                    </div>


                </div>

            @endforeach


        </div>


        <!-- PAGINATION -->

        <div class="pagination">

            {{ $notifications->links() }}

        </div>


    @else


        <!-- EMPTY -->

        <div class="empty">

            <div class="empty-icon">
                🔔
            </div>

            <h3>
                No Notifications
            </h3>

            <p>
                You don't have any notifications yet.
            </p>

        </div>

    @endif


</main>


</body>

</html>

