<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - {{ $advertisement->title }}</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, Helvetica, sans-serif; background: #f3f4f6; color: #111827; }
        
        .header { background: white; border-bottom: 1px solid #e5e7eb; padding: 18px 40px; }
        .header-inner { max-width: 1400px; margin: auto; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 22px; font-weight: bold; color: #111827; text-decoration: none; }
        .logo span { color: #2563eb; }
        .header-actions { display: flex; gap: 20px; }
        .header-link { color: #374151; text-decoration: none; font-size: 14px; font-weight: 600; }
        .header-link:hover { color: #2563eb; }

        .chat-app { max-width: 1400px; margin: 30px auto; display: flex; height: calc(100vh - 140px); min-height: 600px; background: white; border-radius: 16px; box-shadow: 0 5px 25px rgba(0,0,0,0.06); overflow: hidden; }

        /* Sidebar */
        .sidebar { width: 350px; background: #f9fafb; border-right: 1px solid #e5e7eb; display: flex; flex-direction: column; }
        .sidebar-header { padding: 22px 20px; border-bottom: 1px solid #e5e7eb; font-weight: 800; font-size: 18px; display: flex; justify-content: space-between; align-items: center; }
        .conversation-list { flex: 1; overflow-y: auto; }
        .convo-item { display: flex; padding: 16px 20px; border-bottom: 1px solid #e5e7eb; text-decoration: none; color: inherit; transition: 0.2s; align-items: center; }
        .convo-item:hover { background: #f3f4f6; }
        .convo-item.active { background: #eff6ff; border-left: 4px solid #2563eb; padding-left: 16px; }
        .convo-avatar { width: 48px; height: 48px; border-radius: 50%; background: #2563eb; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 16px; margin-right: 15px; flex-shrink: 0; }
        .convo-info { flex: 1; min-width: 0; }
        .convo-name { font-weight: 700; margin: 0 0 5px; font-size: 15px; display: flex; justify-content: space-between; align-items: center; }
        .convo-ad { font-size: 13px; color: #6b7280; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .unread-dot { width: 10px; height: 10px; background: #2563eb; border-radius: 50%; }

        /* Main Chat */
        .main-chat { flex: 1; display: flex; flex-direction: column; background: white; }
        
        .chat-header { padding: 20px 25px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; }
        .chat-user-info { display: flex; align-items: center; gap: 15px; }
        .chat-header-avatar { width: 50px; height: 50px; border-radius: 50%; background: #111827; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 18px; }
        .chat-header-name { font-weight: 800; font-size: 18px; margin: 0 0 5px; }
        .chat-header-ad { font-size: 13px; color: #6b7280; margin: 0; }
        .view-ad-btn { padding: 10px 16px; border: 1px solid #e5e7eb; border-radius: 8px; text-decoration: none; color: #374151; font-size: 13px; font-weight: 700; transition: 0.2s; background: #f9fafb; }
        .view-ad-btn:hover { background: #f3f4f6; border-color: #d1d5db; }

        .messages-area { flex: 1; padding: 25px 30px; overflow-y: auto; background: #f8fafc; }
        
        .message { display: flex; margin-bottom: 25px; }
        .message.sent { justify-content: flex-end; }
        .message.received { justify-content: flex-start; }
        
        .bubble-container { max-width: 70%; display: flex; flex-direction: column; }
        .message.sent .bubble-container { align-items: flex-end; }
        
        .bubble { padding: 14px 20px; border-radius: 20px; font-size: 15px; line-height: 1.5; position: relative; word-wrap: break-word; }
        
        .sent .bubble { background: #2563eb; color: white; border-bottom-right-radius: 4px; box-shadow: 0 3px 10px rgba(37,99,235,0.2); }
        .received .bubble { background: white; color: #111827; border: 1px solid #e5e7eb; border-bottom-left-radius: 4px; box-shadow: 0 3px 10px rgba(0,0,0,0.03); }
        
        .meta { display: flex; align-items: center; gap: 8px; margin-top: 8px; font-size: 12px; }
        .sent .meta { color: #6b7280; flex-direction: row-reverse; }
        .received .meta { color: #6b7280; }
        
        .status-icon { font-size: 14px; display: flex; }
        .status-read { color: #2563eb; }
        .status-unread { color: #9ca3af; }

        .chat-input-area { padding: 20px 30px; border-top: 1px solid #e5e7eb; background: white; }
        .chat-form { display: flex; gap: 15px; align-items: flex-end; }
        .chat-input { flex: 1; padding: 15px 20px; border: 1px solid #d1d5db; border-radius: 24px; font-family: inherit; font-size: 15px; resize: none; outline: none; transition: 0.2s; line-height: 1.4; max-height: 150px; background: #f9fafb; }
        .chat-input:focus { border-color: #2563eb; background: white; box-shadow: 0 0 0 4px rgba(37,99,235,0.1); }
        .send-btn { background: #2563eb; color: white; border: none; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s; font-size: 20px; flex-shrink: 0; box-shadow: 0 4px 10px rgba(37,99,235,0.3); }
        .send-btn:hover { background: #1d4ed8; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(37,99,235,0.4); }

        @media(max-width: 900px) {
            .sidebar { display: none; }
            .chat-app { margin: 0; height: calc(100vh - 75px); border-radius: 0; }
            .messages-area { padding: 20px; }
            .bubble-container { max-width: 85%; }
        }
    </style>
</head>
<body>

<header class="header">
    <div class="header-inner">
        <a href="{{ route('home') }}" class="logo">Advertisement <span>Platform</span></a>
        <div class="header-actions">
            <a href="{{ route('visitor.dashboard') }}" class="header-link">Dashboard</a>
            <a href="{{ route('advertisements.index') }}" class="header-link">Browse Ads</a>
        </div>
    </div>
</header>

<div class="chat-app">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            Conversations
            <a href="{{ route('messages.inbox') }}" style="font-size:13px; color:#2563eb; text-decoration:none;">View Inbox</a>
        </div>
        <div class="conversation-list">
            @foreach($conversations ?? [] as $convo)
                @php
                    $partner = (int)$convo->sender_id === (int)auth()->id() ? $convo->receiver : $convo->sender;
                    $isActive = $partner->id === $other_user->id && $convo->advertisement_id === $advertisement->id;
                    $initial = strtoupper(substr($partner->name ?? 'U', 0, 1));
                    $unread = \App\Models\Message::where('advertisement_id', $convo->advertisement_id)
                        ->where('sender_id', $partner->id)
                        ->where('receiver_id', auth()->id())
                        ->whereNull('read_at')->count();
                @endphp
                <a href="{{ route('messages.conversation', ['advertisement' => $convo->advertisement_id, 'other_user' => $partner->id]) }}" class="convo-item {{ $isActive ? 'active' : '' }}">
                    <div class="convo-avatar">{{ $initial }}</div>
                    <div class="convo-info">
                        <div class="convo-name">
                            {{ $partner->name }}
                            @if($unread > 0)
                                <span class="unread-dot"></span>
                            @endif
                        </div>
                        <p class="convo-ad">{{ $convo->advertisement->title }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Main Chat -->
    <div class="main-chat">
        <div class="chat-header">
            <div class="chat-user-info">
                <div class="chat-header-avatar">{{ strtoupper(substr($other_user->name, 0, 1)) }}</div>
                <div>
                    <p class="chat-header-name">{{ $other_user->name }}</p>
                    <p class="chat-header-ad">{{ $advertisement->title }}</p>
                </div>
            </div>
            <a href="{{ route('advertisements.show', $advertisement) }}" class="view-ad-btn">View Ad</a>
        </div>

        <div class="messages-area" id="messages-area">
            @if($messages->count() > 0)
                @foreach($messages as $msg)
                    @php
                        $isSent = $msg->sender_id === auth()->id();
                    @endphp
                    <div class="message {{ $isSent ? 'sent' : 'received' }}">
                        <div class="bubble-container">
                            <div class="bubble">{{ $msg->message }}</div>
                            <div class="meta">
                                <span>{{ $msg->created_at->format('M d, h:i A') }}</span>
                                @if($isSent)
                                    <span class="status-icon {{ $msg->read_at ? 'status-read' : 'status-unread' }}" title="{{ $msg->read_at ? 'Read' : 'Unread' }}">
                                        {!! $msg->read_at ? '&#10004;&#10004;' : '&#10004;' !!}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div style="height:100%; display:flex; align-items:center; justify-content:center; color:#9ca3af; flex-direction:column;">
                    <div style="font-size:45px; margin-bottom:15px; opacity:0.5;">💬</div>
                    <div style="font-weight:800; color:#4b5563; font-size:18px;">No messages yet</div>
                    <div style="font-size:15px; margin-top:5px;">Say hello to start the conversation!</div>
                </div>
            @endif
        </div>

        <div class="chat-input-area">
            <form method="POST" action="{{ route('messages.send', ['advertisement' => $advertisement->id, 'other_user' => $other_user->id]) }}" class="chat-form">
                @csrf
                <textarea name="message" id="message-input" class="chat-input" rows="1" placeholder="Type a message..." required></textarea>
                <button type="submit" class="send-btn">➤</button>
            </form>
        </div>
    </div>
</div>

<script>
    const messagesArea = document.getElementById('messages-area');
    if (messagesArea) {
        messagesArea.scrollTop = messagesArea.scrollHeight;
    }

    const messageInput = document.getElementById('message-input');
    if (messageInput) {
        messageInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                if(this.value.trim() !== '') {
                    this.closest('form').submit();
                }
            }
        });
        
        // Auto-resize textarea
        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
            if(this.value === '') {
                this.style.height = 'auto';
            }
        });
    }
</script>
</body>
</html>
