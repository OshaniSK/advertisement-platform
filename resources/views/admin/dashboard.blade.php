<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — Control Center</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #0f172a; color: #e2e8f0; min-height: 100vh; }

        /* ===== SIDEBAR ===== */
        .layout { display: flex; min-height: 100vh; }

        .sidebar {
            width: 260px; background: #1e293b; border-right: 1px solid #334155;
            display: flex; flex-direction: column; position: fixed; top: 0; left: 0; height: 100vh; z-index: 100;
        }
        .sidebar-logo {
            padding: 24px 20px; border-bottom: 1px solid #334155;
        }
        .sidebar-logo h2 { font-size: 18px; font-weight: 800; color: #f8fafc; }
        .sidebar-logo span { color: #6366f1; }
        .sidebar-logo p { font-size: 11px; color: #64748b; margin-top: 3px; text-transform: uppercase; letter-spacing: 1px; }

        .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
        .nav-label { font-size: 10px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 1px; padding: 8px 8px 4px; }
        .nav-item {
            display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 8px;
            color: #94a3b8; text-decoration: none; font-size: 14px; font-weight: 500;
            transition: 0.15s; margin-bottom: 2px;
        }
        .nav-item:hover { background: #334155; color: #f1f5f9; }
        .nav-item.active { background: #4f46e5; color: white; }
        .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }

        .sidebar-footer { padding: 16px; border-top: 1px solid #334155; }
        .admin-badge {
            display: flex; align-items: center; gap: 10px; padding: 10px 12px;
            background: #0f172a; border-radius: 10px;
        }
        .admin-avatar {
            width: 36px; height: 36px; border-radius: 50%; background: #4f46e5;
            display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px; color: white;
        }
        .admin-info p { font-size: 13px; font-weight: 600; color: #f1f5f9; }
        .admin-info span { font-size: 11px; color: #64748b; }

        /* ===== MAIN ===== */
        .main { margin-left: 260px; flex: 1; }

        .topbar {
            background: #1e293b; border-bottom: 1px solid #334155;
            padding: 16px 32px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 50;
        }
        .topbar h1 { font-size: 20px; font-weight: 800; color: #f8fafc; }
        .topbar-actions { display: flex; gap: 10px; align-items: center; }
        .topbar-btn {
            display: inline-flex; align-items: center; gap: 6px; padding: 8px 14px; border-radius: 8px;
            font-size: 13px; font-weight: 600; text-decoration: none; border: none; cursor: pointer;
            transition: 0.15s;
        }
        .btn-outline { background: transparent; color: #94a3b8; border: 1px solid #334155; }
        .btn-outline:hover { background: #334155; color: #f1f5f9; }

        .content { padding: 32px; }

        /* ===== ALERTS ===== */
        .alert { padding: 14px 18px; border-radius: 10px; margin-bottom: 24px; font-weight: 600; font-size: 14px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background: #052e16; color: #4ade80; border: 1px solid #166534; }
        .alert-error { background: #2d0a0a; color: #f87171; border: 1px solid #7f1d1d; }

        /* ===== STAT CARDS GRID ===== */
        .section-title { font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px; }

        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 32px; }

        .stat-card {
            background: #1e293b; border: 1px solid #334155; border-radius: 14px; padding: 22px;
            position: relative; overflow: hidden; transition: 0.2s;
        }
        .stat-card:hover { border-color: #475569; transform: translateY(-2px); }
        .stat-card-glow {
            position: absolute; top: -20px; right: -20px; width: 80px; height: 80px;
            border-radius: 50%; opacity: 0.15;
        }
        .stat-label { font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px; }
        .stat-value { font-size: 36px; font-weight: 900; color: #f8fafc; line-height: 1; margin-bottom: 6px; }
        .stat-sub { font-size: 12px; color: #64748b; }
        .stat-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 14px; }
        .stat-icon svg { width: 20px; height: 20px; }

        .c-indigo { background: #312e81; color: #a5b4fc; }
        .c-emerald { background: #064e3b; color: #6ee7b7; }
        .c-amber { background: #451a03; color: #fbbf24; }
        .c-rose { background: #4c0519; color: #fda4af; }
        .c-sky { background: #0c4a6e; color: #7dd3fc; }
        .c-violet { background: #2e1065; color: #c4b5fd; }
        .c-teal { background: #042f2e; color: #5eead4; }
        .c-orange { background: #431407; color: #fdba74; }

        .glow-indigo { background: #6366f1; }
        .glow-emerald { background: #10b981; }
        .glow-amber { background: #f59e0b; }
        .glow-rose { background: #f43f5e; }
        .glow-sky { background: #0ea5e9; }
        .glow-violet { background: #8b5cf6; }
        .glow-teal { background: #14b8a6; }
        .glow-orange { background: #f97316; }

        /* ===== AD STATUS ROW ===== */
        .ad-status-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 32px; }
        .status-card {
            background: #1e293b; border: 1px solid #334155; border-radius: 14px; padding: 20px;
            display: flex; align-items: center; gap: 16px;
        }
        .status-icon { width: 52px; height: 52px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0; }
        .status-number { font-size: 28px; font-weight: 900; }
        .status-text { font-size: 13px; font-weight: 600; color: #64748b; margin-top: 2px; }

        /* ===== TWO COLUMN TABLES ===== */
        .tables-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .table-card { background: #1e293b; border: 1px solid #334155; border-radius: 14px; overflow: hidden; }
        .table-header {
            padding: 18px 22px; border-bottom: 1px solid #334155;
            display: flex; align-items: center; justify-content: space-between;
        }
        .table-header h3 { font-size: 15px; font-weight: 700; color: #f1f5f9; }
        .table-link { font-size: 13px; color: #6366f1; text-decoration: none; font-weight: 600; }
        .table-link:hover { color: #a5b4fc; }

        table { width: 100%; border-collapse: collapse; }
        th { padding: 10px 16px; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; text-align: left; border-bottom: 1px solid #334155; }
        td { padding: 12px 16px; font-size: 13px; color: #cbd5e1; border-bottom: 1px solid #1e293b; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #0f172a; }

        .badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: capitalize; }
        .badge-pending  { background: #451a03; color: #fbbf24; }
        .badge-approved { background: #052e16; color: #4ade80; }
        .badge-rejected { background: #4c0519; color: #fda4af; }
        .badge-admin    { background: #2e1065; color: #c4b5fd; }
        .badge-advertiser { background: #0c4a6e; color: #7dd3fc; }
        .badge-visitor  { background: #1c1917; color: #a8a29e; }

        .action-link { color: #6366f1; font-size: 12px; font-weight: 600; text-decoration: none; }
        .action-link:hover { color: #a5b4fc; }

        .empty-row td { text-align: center; color: #475569; padding: 30px; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 900px) {
            .sidebar { display: none; }
            .main { margin-left: 0; }
            .tables-row { grid-template-columns: 1fr; }
            .ad-status-row { grid-template-columns: 1fr; }
        }
        @media (max-width: 600px) {
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .content { padding: 16px; }
            .topbar { padding: 14px 16px; }
        }
    </style>
</head>
<body>

<div class="layout">

    <!-- ===== SIDEBAR ===== -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <h2>Admin <span>Panel</span></h2>
            <p>Control Center</p>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-label">Overview</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item active">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <div class="nav-label" style="margin-top:12px;">Management</div>
            <a href="{{ route('admin.users.index') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Users
                @php $totalUsers = \App\Models\User::count(); @endphp
                <span style="margin-left:auto;background:#334155;color:#94a3b8;font-size:11px;padding:1px 7px;border-radius:10px;">{{ $totalUsers }}</span>
            </a>
            <a href="{{ route('admin.advertisements.index') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Advertisements
                @if($pendingAds > 0)
                    <span style="margin-left:auto;background:#451a03;color:#fbbf24;font-size:11px;padding:1px 7px;border-radius:10px;">{{ $pendingAds }}</span>
                @endif
            </a>

            <div class="nav-label" style="margin-top:12px;">Account</div>
            <a href="{{ route('home') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                View Site
            </a>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="nav-item" style="width:100%;background:none;border:none;cursor:pointer;text-align:left;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </nav>

        <div class="sidebar-footer">
            <div class="admin-badge">
                <div class="admin-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div class="admin-info">
                    <p>{{ auth()->user()->name }}</p>
                    <span>Administrator</span>
                </div>
            </div>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="main">
        <div class="topbar">
            <h1>Dashboard Overview</h1>
            <div class="topbar-actions">
                <a href="{{ route('admin.advertisements.index') }}?status=pending" class="topbar-btn btn-outline">
                    <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Review Pending ({{ $pendingAds }})
                </a>
            </div>
        </div>

        <div class="content">

            @if(session('success'))
                <div class="alert alert-success">
                    <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">
                    <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            <!-- ===== USER STATS ===== -->
            <div class="section-title">👥 User Metrics</div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-card-glow glow-indigo"></div>
                    <div class="stat-icon c-indigo">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div class="stat-label">Total Users</div>
                    <div class="stat-value">{{ $totalUsers }}</div>
                    <div class="stat-sub">{{ $activeUsers }} active · {{ $disabledUsers }} disabled</div>
                </div>

                <div class="stat-card">
                    <div class="stat-card-glow glow-sky"></div>
                    <div class="stat-icon c-sky">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    </div>
                    <div class="stat-label">Advertisers</div>
                    <div class="stat-value">{{ $totalAdvertisers }}</div>
                    <div class="stat-sub">Posting advertisements</div>
                </div>

                <div class="stat-card">
                    <div class="stat-card-glow glow-teal"></div>
                    <div class="stat-icon c-teal">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="stat-label">Visitors / Buyers</div>
                    <div class="stat-value">{{ $totalVisitors }}</div>
                    <div class="stat-sub">Browsing & messaging</div>
                </div>

                <div class="stat-card">
                    <div class="stat-card-glow glow-violet"></div>
                    <div class="stat-icon c-violet">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <div class="stat-label">Total Messages</div>
                    <div class="stat-value">{{ $totalMessages }}</div>
                    <div class="stat-sub">Across all conversations</div>
                </div>
            </div>

            <!-- ===== AD STATUS CARDS ===== -->
            <div class="section-title">📋 Advertisement Status</div>
            <div class="ad-status-row" style="grid-template-columns: repeat(4,1fr); margin-bottom:32px;">
                <div class="status-card">
                    <div class="status-icon" style="background:#1e3a5f;">📋</div>
                    <div>
                        <div class="status-number" style="color:#93c5fd;">{{ $totalAds }}</div>
                        <div class="status-text">Total Ads</div>
                    </div>
                </div>
                <div class="status-card">
                    <div class="status-icon" style="background:#451a03;">⏳</div>
                    <div>
                        <div class="status-number" style="color:#fbbf24;">{{ $pendingAds }}</div>
                        <div class="status-text">Pending Review</div>
                    </div>
                </div>
                <div class="status-card">
                    <div class="status-icon" style="background:#052e16;">✅</div>
                    <div>
                        <div class="status-number" style="color:#4ade80;">{{ $approvedAds }}</div>
                        <div class="status-text">Approved / Live</div>
                    </div>
                </div>
                <div class="status-card">
                    <div class="status-icon" style="background:#4c0519;">❌</div>
                    <div>
                        <div class="status-number" style="color:#fda4af;">{{ $rejectedAds }}</div>
                        <div class="status-text">Rejected</div>
                    </div>
                </div>
            </div>

            <!-- ===== RECENT TABLES ===== -->
            <div class="tables-row">

                <!-- Recent Pending Ads -->
                <div class="table-card">
                    <div class="table-header">
                        <h3>⏳ Pending Review</h3>
                        <a href="{{ route('admin.advertisements.index') }}?status=pending" class="table-link">View All →</a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Advertiser</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPending as $ad)
                                <tr>
                                    <td>
                                        <div style="font-weight:600;color:#f1f5f9;max-width:140px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $ad->title }}</div>
                                        <div style="font-size:11px;color:#64748b;">{{ $ad->category }}</div>
                                    </td>
                                    <td>{{ $ad->user->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.advertisements.index') }}?status=pending" class="action-link">Review</a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="empty-row"><td colspan="3">🎉 No pending ads!</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Recent Users -->
                <div class="table-card">
                    <div class="table-header">
                        <h3>👤 Recent Users</h3>
                        <a href="{{ route('admin.users.index') }}" class="table-link">View All →</a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentUsers as $user)
                                <tr>
                                    <td>
                                        <div style="font-weight:600;color:#f1f5f9;">{{ $user->name }}</div>
                                        <div style="font-size:11px;color:#64748b;">{{ $user->email }}</div>
                                    </td>
                                    <td><span class="badge badge-{{ $user->role }}">{{ $user->role }}</span></td>
                                    <td>
                                        @if($user->is_active)
                                            <span class="badge badge-approved">Active</span>
                                        @else
                                            <span class="badge badge-rejected">Disabled</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr class="empty-row"><td colspan="3">No users found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </main>

</div>

</body>
</html>