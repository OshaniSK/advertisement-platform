<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, Helvetica, sans-serif; background: #f3f4f6; color: #111827; }

        /* Header */
        .header { background: white; border-bottom: 1px solid #e5e7eb; padding: 18px 40px; }
        .header-inner { max-width: 1000px; margin: auto; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 22px; font-weight: bold; color: #111827; text-decoration: none; }
        .logo span { color: #2563eb; }
        .header-links { display: flex; align-items: center; gap: 15px; }
        .header-link { color: #374151; text-decoration: none; font-size: 14px; font-weight: 600; }
        .header-link:hover { color: #2563eb; }

        .container { max-width: 1000px; margin: 35px auto; padding: 0 20px; }

        .page-header { margin-bottom: 25px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 15px; }
        .page-header h1 { margin: 0 0 5px; font-size: 28px; font-weight: 800; }
        .page-header p { margin: 0; color: #6b7280; }

        .button { display: inline-flex; align-items: center; padding: 10px 16px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 700; border: none; cursor: pointer; transition: 0.2s; }
        .read-all-button { background: #2563eb; color: white; }
        .read-all-button:hover { background: #1d4ed8; }

        /* Alerts */
        .alert { padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-weight: 600; }
        .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        /* Card list */
        .card { background: white; border-radius: 16px; box-shadow: 0 4px 18px rgba(0,0,0,0.04); overflow: hidden; }
        
        .notification-list { display: flex; flex-direction: column; }
        
        .notification { display: flex; padding: 22px 25px; border-bottom: 1px solid #e5e7eb; transition: 0.2s; align-items: flex-start; gap: 20px; position: relative; }
        .notification:last-child { border-bottom: none; }
        .notification:hover { background: #f9fafb; }
        .notification.unread { background: #eff6ff; }
        .notification.unread:hover { background: #e0f2fe; }

        /* Dot indicator for unread */
        .unread-dot { width: 12px; height: 12px; background: #2563eb; border-radius: 50%; position: absolute; left: 16px; top: 38px; display: none; }
        .notification.unread .unread-dot { display: block; }
        .notification.unread { padding-left: 40px; } /* make room for dot */

        /* Icon */
        .notif-icon-wrap { width: 45px; height: 45px; border-radius: 50%; background: #dbeafe; color: #2563eb; display: flex; justify-content: center; align-items: center; font-size: 20px; flex-shrink: 0; }
        .notification.unread .notif-icon-wrap { background: #2563eb; color: white; }

        /* Content */
        .notif-content { flex: 1; }
        .notif-title { margin: 0 0 6px; font-size: 16px; font-weight: 800; color: #111827; }
        .notif-message { margin: 0 0 8px; color: #4b5563; font-size: 14.5px; line-height: 1.5; }
        .notif-time { color: #9ca3af; font-size: 12.5px; font-weight: 600; }

        /* Actions */
        .notif-actions { display: flex; flex-direction: column; gap: 10px; align-items: flex-end; }
        .action-btn { display: inline-flex; align-items: center; justify-content: center; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none; border: none; cursor: pointer; transition: 0.2s; width: 120px; }
        .action-open { background: #111827; color: white; }
        .action-open:hover { background: #374151; }
        .action-read { background: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; }
        .action-read:hover { background: #e5e7eb; }

        .status-badge { padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px; text-align: center; width: 120px; }
        .status-unread { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
        .status-read { background: #f3f4f6; color: #6b7280; border: 1px solid #e5e7eb; }

        /* Empty state */
        .empty-state { text-align: center; padding: 70px 20px; color: #6b7280; }
        .empty-icon { font-size: 55px; margin-bottom: 20px; opacity: 0.7; }
        .empty-state h3 { color: #111827; margin: 0 0 10px; font-size: 22px; font-weight: 800; }
        .empty-state p { margin: 0; font-size: 15px; }

        /* Pagination */
        .pagination { margin-top: 25px; display: flex; justify-content: center; }

        @media (max-width: 700px) {
            .notification { flex-direction: column; }
            .notif-actions { width: 100%; flex-direction: row; align-items: center; justify-content: flex-start; flex-wrap: wrap; margin-top: 10px; }
            .status-badge { display: none; }
            .notification.unread { padding-left: 20px; }
            .notification.unread .unread-dot { display: none; }
        }
    </style>
</head>
<body>

<header class="header">
    <div class="header-inner">
        <a href="{{ route('home') }}" class="logo">Advertisement <span>Platform</span></a>

        <div class="header-links">
            @if (auth()->user()->role === 'advertiser')
                <a href="{{ route('advertiser.dashboard') }}" class="header-link">Dashboard</a>
            @elseif (auth()->user()->role === 'visitor')
                <a href="{{ route('visitor.dashboard') }}" class="header-link">Dashboard</a>
            @elseif (auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="header-link">Dashboard</a>
            @endif
        </div>
    </div>
</header>

<main class="container">

    <div class="page-header">
        <div>
            <h1>Notifications</h1>
            <p>Stay updated with your latest activity.</p>
        </div>

        @if (auth()->user()->unreadNotifications()->count() > 0)
            <form method="POST" action="{{ route('notifications.readAll') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="button read-all-button">
                    <svg style="width:16px;height:16px;margin-right:6px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Mark All as Read
                </button>
            </form>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    @if ($notifications->count() > 0)
        <div class="card">
            <div class="notification-list">
                @foreach ($notifications as $notification)
                    <div class="notification {{ $notification->read_at === null ? 'unread' : '' }}">
                        <div class="unread-dot"></div>
                        
                        <div class="notif-icon-wrap">
                            @if(isset($notification->data['type']) && $notification->data['type'] === 'message')
                                💬
                            @else
                                🔔
                            @endif
                        </div>

                        <div class="notif-content">
                            <h3 class="notif-title">{{ $notification->data['sender_name'] ?? 'New Notification' }}</h3>
                            <p class="notif-message">{{ $notification->data['message'] ?? 'You have a new notification.' }}</p>
                            <div class="notif-time">{{ $notification->created_at->format('M d, Y • h:i A') }}</div>
                        </div>

                        <div class="notif-actions">
                            @if ($notification->read_at === null)
                                <div class="status-badge status-unread">Unread</div>
                            @else
                                <div class="status-badge status-read">Read</div>
                            @endif

                            @if (isset($notification->data['advertisement_id']) && isset($notification->data['sender_id']))
                                <a href="{{ route('notifications.open', $notification->id) }}" class="action-btn action-open">
                                    Open
                                </a>
                            @endif

                            @if ($notification->read_at === null)
                                <form method="POST" action="{{ route('notifications.read', $notification->id) }}" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="action-btn action-read">Mark Read</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="pagination">
            {{ $notifications->links() }}
        </div>
    @else
        <div class="empty-state card">
            <div class="empty-icon">🔔</div>
            <h3>No Notifications</h3>
            <p>You're all caught up! Check back later.</p>
        </div>
    @endif

</main>

</body>
</html>

