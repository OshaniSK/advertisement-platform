<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Messages</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, Helvetica, sans-serif; background: #f3f4f6; color: #111827; }
        
        /* Header */
        .header { background: white; border-bottom: 1px solid #e5e7eb; padding: 18px 40px; }
        .header-inner { max-width: 1000px; margin: auto; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 22px; font-weight: bold; color: #111827; text-decoration: none; }
        .logo span { color: #2563eb; }
        .header-link { color: #374151; text-decoration: none; font-size: 14px; font-weight: 600; }
        .header-link:hover { color: #2563eb; }
        
        .container { max-width: 1000px; margin: 35px auto; padding: 0 20px; }
        
        .page-header { margin-bottom: 25px; display: flex; justify-content: space-between; align-items: flex-end; }
        .page-header h1 { margin: 0 0 5px; font-size: 28px; font-weight: 800; }
        .page-header p { margin: 0; color: #6b7280; }
        
        .card { background: white; border-radius: 16px; box-shadow: 0 4px 18px rgba(0,0,0,0.04); overflow: hidden; }
        
        .conversation-list { display: flex; flex-direction: column; }
        .convo-item { display: flex; padding: 20px 25px; border-bottom: 1px solid #e5e7eb; text-decoration: none; color: inherit; transition: 0.2s; align-items: center; }
        .convo-item:last-child { border-bottom: none; }
        .convo-item:hover { background: #f9fafb; }
        .convo-item.unread { background: #eff6ff; }
        .convo-item.unread:hover { background: #e0f2fe; }
        
        .convo-avatar { width: 55px; height: 55px; border-radius: 50%; background: #2563eb; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 20px; margin-right: 20px; flex-shrink: 0; }
        .convo-info { flex: 1; min-width: 0; }
        .convo-name { font-weight: 800; margin: 0 0 4px; font-size: 17px; display: flex; justify-content: space-between; align-items: center; }
        .convo-ad { font-size: 14px; color: #2563eb; font-weight: 600; margin: 0 0 6px; }
        .convo-last { font-size: 14px; color: #6b7280; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        
        .convo-date { font-size: 12px; color: #9ca3af; font-weight: 600; }
        .unread-badge { background: #2563eb; color: white; padding: 2px 8px; border-radius: 12px; font-size: 11px; font-weight: bold; margin-left: 8px; }

        .arrow { font-size: 24px; color: #d1d5db; margin-left: 15px; transition: 0.2s; }
        .convo-item:hover .arrow { color: #9ca3af; transform: translateX(3px); }

        .empty-state { text-align: center; padding: 60px 20px; color: #6b7280; }
        .empty-icon { font-size: 50px; margin-bottom: 15px; opacity: 0.6; }
        .empty-state h2 { color: #111827; margin: 0 0 10px; font-weight: 800; }
        .browse-btn { display: inline-block; margin-top: 20px; background: #2563eb; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 700; transition: 0.2s; }
        .browse-btn:hover { background: #1d4ed8; }

        @media(max-width: 600px) {
            .convo-item { padding: 15px; }
            .convo-avatar { width: 45px; height: 45px; font-size: 16px; margin-right: 15px; }
            .convo-date { display: none; }
        }
    </style>
</head>
<body>

<header class="header">
    <div class="header-inner">
        <a href="{{ route('home') }}" class="logo">Advertisement <span>Platform</span></a>
        
        @if(auth()->user()->role === 'advertiser')
            <a href="{{ route('advertiser.dashboard') }}" class="header-link">&larr; Dashboard</a>
        @elseif(auth()->user()->role === 'visitor')
            <a href="{{ route('visitor.dashboard') }}" class="header-link">&larr; Dashboard</a>
        @else
            <a href="{{ route('advertisements.index') }}" class="header-link">&larr; Advertisements</a>
        @endif
    </div>
</header>

<main class="container">
    <div class="page-header">
        <div>
            <h1>My Messages</h1>
            <p>Your conversations with buyers and sellers.</p>
        </div>
    </div>

    <div class="card">
        @if($messages->count() > 0)
            <div class="conversation-list">
                @foreach($messages as $message)
                    @php
                        $otherUser = (int)$message->sender_id === (int)auth()->id() ? $message->receiver : $message->sender;
                        $initial = strtoupper(substr($otherUser->name ?? 'U', 0, 1));
                        
                        $unreadCount = \App\Models\Message::where('advertisement_id', $message->advertisement_id)
                            ->where('sender_id', $otherUser->id)
                            ->where('receiver_id', auth()->id())
                            ->whereNull('read_at')->count();
                    @endphp
                    
                    <a href="{{ route('messages.conversation', ['advertisement' => $message->advertisement_id, 'other_user' => $otherUser->id]) }}" class="convo-item {{ $unreadCount > 0 ? 'unread' : '' }}">
                        <div class="convo-avatar">{{ $initial }}</div>
                        
                        <div class="convo-info">
                            <div class="convo-name">
                                <div>
                                    {{ $otherUser->name }}
                                    @if($unreadCount > 0)
                                        <span class="unread-badge">{{ $unreadCount }} new</span>
                                    @endif
                                </div>
                                <span class="convo-date">{{ $message->created_at->format('d M, h:i A') }}</span>
                            </div>
                            
                            <p class="convo-ad">{{ $message->advertisement->title }}</p>
                            <p class="convo-last">{{ $message->message }}</p>
                        </div>
                        
                        <div class="arrow">&rsaquo;</div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">💬</div>
                <h2>No messages yet</h2>
                <p>Your conversations will appear here.</p>
                <a href="{{ route('advertisements.index') }}" class="browse-btn">Browse Advertisements</a>
            </div>
        @endif
    </div>
</main>

</body>
</html>
