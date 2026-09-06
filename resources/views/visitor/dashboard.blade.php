<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Dashboard - Advertisement Platform</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f3f4f6;
            color: #111827;
        }
        /* Header */
        .header {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 18px 40px;
        }
        .header-inner {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo { font-size: 22px; font-weight: bold; color: #111827; text-decoration: none; }
        .logo span { color: #2563eb; }
        .header-actions { display: flex; align-items: center; gap: 20px; }
        .header-link { color: #374151; text-decoration: none; font-size: 14px; font-weight: 600; }
        .header-link:hover { color: #2563eb; }
        
        .logout-btn {
            background: #fee2e2;
            color: #dc2626;
            border: none;
            padding: 9px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
            font-size: 14px;
            transition: 0.2s;
        }
        .logout-btn:hover { background: #fecaca; }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 35px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 30px;
        }

        @media(max-width: 900px) {
            .container { grid-template-columns: 1fr; }
        }

        /* Sections */
        .section-title {
            font-size: 20px;
            font-weight: 800;
            margin: 0 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .view-all { font-size: 14px; color: #2563eb; text-decoration: none; font-weight: 600; }
        .view-all:hover { text-decoration: underline; }

        .card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.04);
            margin-bottom: 30px;
        }

        /* Favorites Grid */
        .favorites-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }
        .favorite-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            text-decoration: none;
            color: inherit;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .favorite-card:hover { transform: translateY(-4px); box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
        .favorite-img { width: 100%; height: 160px; object-fit: cover; background: #f3f4f6; }
        .favorite-info { padding: 18px; flex: 1; display: flex; flex-direction: column; }
        .favorite-title { font-weight: 700; margin: 0 0 8px; font-size: 16px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .favorite-price { color: #111827; font-weight: 800; font-size: 18px; margin: 0 0 15px; }
        
        .remove-favorite {
            margin-top: auto;
            background: #f3f4f6;
            color: #4b5563;
            border: 1px solid #e5e7eb;
            padding: 9px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            transition: 0.2s;
        }
        .remove-favorite:hover { background: #fee2e2; color: #dc2626; border-color: #fecaca; }

        /* Messages List */
        .message-list { display: flex; flex-direction: column; }
        .message-item {
            display: flex;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid #e5e7eb;
            text-decoration: none;
            color: inherit;
            transition: 0.2s;
        }
        .message-item:last-child { border-bottom: none; }
        .message-item:hover { background: #f9fafb; margin: 0 -15px; padding: 16px 15px; border-radius: 10px; border-bottom-color: transparent; }
        .message-avatar {
            width: 48px; height: 48px; border-radius: 50%; background: #2563eb; color: white;
            display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 18px; margin-right: 15px; flex-shrink: 0;
        }
        .message-content { flex: 1; min-width: 0; }
        .message-name { font-weight: 700; margin: 0 0 5px; font-size: 15px; }
        .message-ad { font-size: 13px; color: #6b7280; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin: 0; }
        
        /* Notifications */
        .notification-list { display: flex; flex-direction: column; gap: 12px; }
        .notification-item {
            padding: 16px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            display: flex;
            gap: 15px;
            background: white;
            transition: 0.2s;
            text-decoration: none;
            color: inherit;
        }
        .notification-item:hover { background: #f9fafb; }
        .notification-item.unread {
            background: #eff6ff;
            border-color: #bfdbfe;
        }
        .notification-item.unread:hover { background: #dbeafe; }
        
        .notification-icon {
            width: 40px; height: 40px; border-radius: 50%; background: #e5e7eb; color: #4b5563;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 18px;
        }
        .notification-item.unread .notification-icon { background: #2563eb; color: white; }
        .notification-text { flex: 1; }
        .notification-title { font-weight: 700; font-size: 14px; margin: 0 0 5px; }
        .notification-desc { font-size: 13px; color: #4b5563; margin: 0 0 8px; line-height: 1.4; }
        .notification-time { font-size: 11px; color: #9ca3af; font-weight: 600; }

        .empty-state { text-align: center; padding: 40px 20px; color: #6b7280; font-size: 15px; background: #f9fafb; border-radius: 12px; border: 1px dashed #d1d5db; }
        
        .badge {
            background: #ef4444; color: white; padding: 3px 9px; border-radius: 12px; font-size: 12px; font-weight: 800; margin-left: 8px;
        }
    </style>
</head>
<body>

<header class="header">
    <div class="header-inner">
        <a href="{{ route('home') }}" class="logo">Advertisement <span>Platform</span></a>
        <div class="header-actions">
            <a href="{{ route('advertisements.index') }}" class="header-link">Browse Ads</a>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="logout-btn">Log Out</button>
            </form>
        </div>
    </div>
</header>

<div class="container">
    
    <!-- Left Column: Favorites -->
    <div>
        <div class="card">
            <h2 class="section-title">
                My Favorites
                <a href="{{ route('favorites.index') }}" class="view-all">View All &rarr;</a>
            </h2>
            
            @if($favorites->count() > 0)
                <div class="favorites-grid">
                    @foreach($favorites as $favorite)
                        <a href="{{ route('advertisements.show', $favorite->advertisement) }}" class="favorite-card">
                            @if($favorite->advertisement->image)
                                <img src="{{ asset('storage/' . $favorite->advertisement->image) }}" class="favorite-img" alt="Ad">
                            @else
                                <div class="favorite-img" style="display:flex;align-items:center;justify-content:center;color:#9ca3af;font-size:14px;">No Image</div>
                            @endif
                            <div class="favorite-info">
                                <p class="favorite-title">{{ $favorite->advertisement->title }}</p>
                                <p class="favorite-price">Rs. {{ number_format($favorite->advertisement->price, 2) }}</p>
                                
                                <form action="{{ route('favorites.destroy', $favorite->advertisement) }}" method="POST" style="margin-top:auto;" onsubmit="event.stopPropagation();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove-favorite">❤️ Remove</button>
                                </form>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    You haven't saved any advertisements yet.
                </div>
            @endif
        </div>
    </div>

    <!-- Right Column: Messages & Notifications -->
    <div>
        <!-- Messages Section -->
        <div class="card">
            <h2 class="section-title">
                <div style="display:flex;align-items:center;">
                    My Messages @if($unreadMessages > 0)<span class="badge">{{ $unreadMessages }}</span>@endif
                </div>
                <a href="{{ route('messages.inbox') }}" class="view-all">Inbox &rarr;</a>
            </h2>
            
            @if($messages->count() > 0)
                <div class="message-list">
                    @foreach($messages as $message)
                        @php
                            $otherUser = (int)$message->sender_id === (int)auth()->id() ? $message->receiver : $message->sender;
                            $initial = strtoupper(substr($otherUser->name ?? 'U', 0, 1));
                        @endphp
                        <a href="{{ route('messages.conversation', ['advertisement' => $message->advertisement_id, 'other_user' => $otherUser->id]) }}" class="message-item">
                            <div class="message-avatar">{{ $initial }}</div>
                            <div class="message-content">
                                <p class="message-name">{{ $otherUser->name }}</p>
                                <p class="message-ad">{{ $message->advertisement->title }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="empty-state">No recent conversations.</div>
            @endif
        </div>

        <!-- Notifications Section -->
        <div class="card">
            <h2 class="section-title">
                Notifications
                <a href="{{ route('notifications.index') }}" class="view-all">All &rarr;</a>
            </h2>
            
            @if($notifications->count() > 0)
                <div class="notification-list">
                    @foreach($notifications as $notification)
                        @php
                            $hasLink = isset($notification->data['advertisement_id']);
                            $tag = $hasLink ? 'a' : 'div';
                            $href = $hasLink ? 'href="'.route('notifications.open', $notification->id).'"' : '';
                        @endphp
                        <{!! $tag !!} {!! $href !!} class="notification-item {{ $notification->read_at === null ? 'unread' : '' }}">
                            <div class="notification-icon">🔔</div>
                            <div class="notification-text">
                                <p class="notification-title">{{ $notification->data['sender_name'] ?? 'System' }}</p>
                                <p class="notification-desc">{{ $notification->data['message'] ?? 'You have a new notification.' }}</p>
                                <p class="notification-time">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </{!! $tag !!}>
                    @endforeach
                </div>
            @else
                <div class="empty-state">No recent notifications.</div>
            @endif
        </div>
    </div>

</div>

</body>
</html>