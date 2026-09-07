<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management — Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #0f172a; color: #e2e8f0; min-height: 100vh; }

        /* LAYOUT */
        .layout { display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar { width: 260px; background: #1e293b; border-right: 1px solid #334155; display: flex; flex-direction: column; position: fixed; top: 0; left: 0; height: 100vh; z-index: 100; }
        .sidebar-logo { padding: 24px 20px; border-bottom: 1px solid #334155; }
        .sidebar-logo h2 { font-size: 18px; font-weight: 800; color: #f8fafc; }
        .sidebar-logo span { color: #6366f1; }
        .sidebar-logo p { font-size: 11px; color: #64748b; margin-top: 3px; text-transform: uppercase; letter-spacing: 1px; }
        .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
        .nav-label { font-size: 10px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 1px; padding: 8px 8px 4px; }
        .nav-item { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 8px; color: #94a3b8; text-decoration: none; font-size: 14px; font-weight: 500; transition: 0.15s; margin-bottom: 2px; }
        .nav-item:hover { background: #334155; color: #f1f5f9; }
        .nav-item.active { background: #4f46e5; color: white; }
        .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }
        .sidebar-footer { padding: 16px; border-top: 1px solid #334155; }
        .admin-badge { display: flex; align-items: center; gap: 10px; padding: 10px 12px; background: #0f172a; border-radius: 10px; }
        .admin-avatar { width: 36px; height: 36px; border-radius: 50%; background: #4f46e5; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px; color: white; }
        .admin-info p { font-size: 13px; font-weight: 600; color: #f1f5f9; }
        .admin-info span { font-size: 11px; color: #64748b; }

        /* MAIN */
        .main { margin-left: 260px; flex: 1; }
        .topbar { background: #1e293b; border-bottom: 1px solid #334155; padding: 16px 32px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 50; }
        .topbar h1 { font-size: 20px; font-weight: 800; color: #f8fafc; }
        .content { padding: 32px; }

        /* ALERTS */
        .alert { padding: 14px 18px; border-radius: 10px; margin-bottom: 24px; font-weight: 600; font-size: 14px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background: #052e16; color: #4ade80; border: 1px solid #166534; }
        .alert-error { background: #2d0a0a; color: #f87171; border: 1px solid #7f1d1d; }

        /* FILTER BAR */
        .filter-bar {
            background: #1e293b; border: 1px solid #334155; border-radius: 14px; padding: 20px 24px;
            display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap; margin-bottom: 24px;
        }
        .filter-group { display: flex; flex-direction: column; gap: 6px; }
        .filter-group label { font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
        .filter-input, .filter-select {
            background: #0f172a; border: 1px solid #334155; color: #e2e8f0; border-radius: 8px;
            padding: 9px 14px; font-size: 14px; font-family: inherit; outline: none; transition: 0.15s;
        }
        .filter-input { min-width: 280px; }
        .filter-select { min-width: 140px; cursor: pointer; }
        .filter-input:focus, .filter-select:focus { border-color: #6366f1; }
        .filter-btn {
            padding: 9px 18px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; font-weight: 700;
            font-family: inherit; transition: 0.15s;
        }
        .btn-primary { background: #4f46e5; color: white; }
        .btn-primary:hover { background: #4338ca; }
        .btn-ghost { background: #334155; color: #94a3b8; }
        .btn-ghost:hover { background: #475569; color: #f1f5f9; }

        /* STATS ROW */
        .stats-mini { display: flex; gap: 16px; margin-bottom: 24px; flex-wrap: wrap; }
        .stat-mini { background: #1e293b; border: 1px solid #334155; border-radius: 10px; padding: 14px 20px; display: flex; align-items: center; gap: 12px; flex: 1; min-width: 140px; }
        .stat-mini-val { font-size: 22px; font-weight: 900; color: #f8fafc; }
        .stat-mini-label { font-size: 12px; color: #64748b; margin-top: 2px; }
        .dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }

        /* TABLE */
        .table-card { background: #1e293b; border: 1px solid #334155; border-radius: 14px; overflow: hidden; }
        .table-header { padding: 18px 22px; border-bottom: 1px solid #334155; display: flex; align-items: center; justify-content: space-between; }
        .table-header h3 { font-size: 15px; font-weight: 700; color: #f1f5f9; }
        .count-badge { background: #334155; color: #94a3b8; font-size: 12px; font-weight: 700; padding: 3px 10px; border-radius: 20px; }

        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { padding: 11px 18px; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; text-align: left; border-bottom: 1px solid #334155; background: #172033; }
        .data-table td { padding: 14px 18px; font-size: 13px; color: #cbd5e1; border-bottom: 1px solid #0f172a; vertical-align: middle; }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: #131f30; }

        .user-cell { display: flex; align-items: center; gap: 12px; }
        .user-avatar { width: 38px; height: 38px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px; color: white; flex-shrink: 0; }
        .user-name { font-weight: 600; color: #f1f5f9; }
        .user-email { font-size: 12px; color: #64748b; margin-top: 1px; }

        .badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: capitalize; }
        .badge-admin     { background: #2e1065; color: #c4b5fd; }
        .badge-advertiser{ background: #0c4a6e; color: #7dd3fc; }
        .badge-visitor   { background: #1c1917; color: #a8a29e; }
        .badge-active    { background: #052e16; color: #4ade80; }
        .badge-disabled  { background: #4c0519; color: #fda4af; }

        /* INLINE FORM ACTIONS */
        .actions-cell { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .role-form { display: flex; align-items: center; gap: 6px; }
        .role-select {
            background: #0f172a; border: 1px solid #334155; color: #e2e8f0; border-radius: 6px;
            padding: 5px 8px; font-size: 12px; font-family: inherit; cursor: pointer; outline: none;
        }
        .role-select:focus { border-color: #6366f1; }
        .btn-xs {
            padding: 5px 10px; border-radius: 6px; border: none; cursor: pointer; font-size: 12px;
            font-weight: 700; font-family: inherit; transition: 0.15s;
        }
        .btn-save { background: #4f46e5; color: white; }
        .btn-save:hover { background: #4338ca; }
        .btn-toggle-active { background: #052e16; color: #4ade80; border: 1px solid #166534; }
        .btn-toggle-active:hover { background: #14532d; }
        .btn-toggle-disable { background: #4c0519; color: #fda4af; border: 1px solid #9f1239; }
        .btn-toggle-disable:hover { background: #831843; }
        .btn-delete { background: transparent; color: #ef4444; border: 1px solid #7f1d1d; }
        .btn-delete:hover { background: #7f1d1d; color: #fca5a5; }

        /* PAGINATION */
        .pagination-wrap { padding: 16px 22px; border-top: 1px solid #334155; display: flex; justify-content: flex-end; }
        .pagination-wrap .pagination { display: flex; gap: 4px; }
        .pagination-wrap nav span, .pagination-wrap nav a {
            padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 600; display: inline-block; text-decoration: none;
        }
        .pagination-wrap nav a { background: #334155; color: #94a3b8; }
        .pagination-wrap nav a:hover { background: #475569; color: #f1f5f9; }
        .pagination-wrap nav span[aria-current] { background: #4f46e5; color: white; }

        /* DELETE CONFIRM MODAL */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.7); z-index: 200; align-items: center; justify-content: center; }
        .modal-overlay.open { display: flex; }
        .modal { background: #1e293b; border: 1px solid #334155; border-radius: 16px; padding: 32px; max-width: 400px; width: 90%; }
        .modal h3 { font-size: 18px; font-weight: 800; color: #f8fafc; margin-bottom: 10px; }
        .modal p { color: #94a3b8; font-size: 14px; line-height: 1.6; margin-bottom: 24px; }
        .modal-actions { display: flex; gap: 10px; justify-content: flex-end; }
        .btn-cancel { background: #334155; color: #94a3b8; padding: 10px 18px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; font-weight: 700; font-family: inherit; }
        .btn-cancel:hover { background: #475569; }
        .btn-danger { background: #dc2626; color: white; padding: 10px 18px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; font-weight: 700; font-family: inherit; }
        .btn-danger:hover { background: #b91c1c; }

        /* EMPTY */
        .empty-row td { text-align: center; color: #475569; padding: 50px; }

        @media (max-width: 900px) {
            .sidebar { display: none; }
            .main { margin-left: 0; }
            .filter-input { min-width: 100%; }
        }
        @media (max-width: 600px) {
            .content { padding: 16px; }
            .topbar { padding: 14px 16px; }
            .actions-cell { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>

<!-- Delete Confirm Modal -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal">
        <h3>⚠️ Delete User</h3>
        <p>Are you sure you want to permanently delete <strong id="deleteUserName"></strong>? This will also delete all their advertisements, messages, and favorites. This action cannot be undone.</p>
        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>
            <form id="deleteForm" method="POST" style="margin:0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">Delete Permanently</button>
            </form>
        </div>
    </div>
</div>

<div class="layout">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <h2>Admin <span>Panel</span></h2>
            <p>Control Center</p>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-label">Overview</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            <div class="nav-label" style="margin-top:12px;">Management</div>
            <a href="{{ route('admin.users.index') }}" class="nav-item active">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Users
            </a>
            <a href="{{ route('admin.advertisements.index') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Advertisements
            </a>
            <div class="nav-label" style="margin-top:12px;">Account</div>
            <a href="{{ route('home') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
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

    <!-- MAIN -->
    <main class="main">
        <div class="topbar">
            <h1>👥 User Management</h1>
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

            <!-- Quick Stats -->
            <div class="stats-mini">
                @php
                    $allUsers = \App\Models\User::count();
                    $allActive = \App\Models\User::where('is_active', true)->count();
                    $allDisabled = \App\Models\User::where('is_active', false)->count();
                    $allAdmins = \App\Models\User::where('role', 'admin')->count();
                    $allAdvertisers = \App\Models\User::where('role', 'advertiser')->count();
                    $allVisitors = \App\Models\User::where('role', 'visitor')->count();
                @endphp
                <div class="stat-mini">
                    <div class="dot" style="background:#6366f1;"></div>
                    <div><div class="stat-mini-val">{{ $allUsers }}</div><div class="stat-mini-label">Total Users</div></div>
                </div>
                <div class="stat-mini">
                    <div class="dot" style="background:#10b981;"></div>
                    <div><div class="stat-mini-val">{{ $allActive }}</div><div class="stat-mini-label">Active</div></div>
                </div>
                <div class="stat-mini">
                    <div class="dot" style="background:#f43f5e;"></div>
                    <div><div class="stat-mini-val">{{ $allDisabled }}</div><div class="stat-mini-label">Disabled</div></div>
                </div>
                <div class="stat-mini">
                    <div class="dot" style="background:#8b5cf6;"></div>
                    <div><div class="stat-mini-val">{{ $allAdvertisers }}</div><div class="stat-mini-label">Advertisers</div></div>
                </div>
                <div class="stat-mini">
                    <div class="dot" style="background:#14b8a6;"></div>
                    <div><div class="stat-mini-val">{{ $allVisitors }}</div><div class="stat-mini-label">Visitors</div></div>
                </div>
            </div>

            <!-- Filter Bar -->
            <form method="GET" action="{{ route('admin.users.index') }}" class="filter-bar">
                <div class="filter-group" style="flex:1;">
                    <label>Search</label>
                    <input type="text" name="search" class="filter-input" placeholder="Name or email address..." value="{{ request('search') }}">
                </div>
                <div class="filter-group">
                    <label>Role</label>
                    <select name="role" class="filter-select">
                        <option value="">All Roles</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="advertiser" {{ request('role') === 'advertiser' ? 'selected' : '' }}>Advertiser</option>
                        <option value="visitor" {{ request('role') === 'visitor' ? 'selected' : '' }}>Visitor</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Status</label>
                    <select name="status" class="filter-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="disabled" {{ request('status') === 'disabled' ? 'selected' : '' }}>Disabled</option>
                    </select>
                </div>
                <button type="submit" class="filter-btn btn-primary">Search</button>
                <a href="{{ route('admin.users.index') }}" class="filter-btn btn-ghost" style="text-decoration:none;">Reset</a>
            </form>

            <!-- Users Table -->
            <div class="table-card">
                <div class="table-header">
                    <h3>All Users</h3>
                    <span class="count-badge">{{ $users->total() }} found</span>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            @php
                                $avatarColors = ['advertiser' => '#0c4a6e', 'visitor' => '#064e3b', 'admin' => '#2e1065'];
                                $avatarColor = $avatarColors[$user->role] ?? '#1e3a5f';
                            @endphp
                            <tr>
                                <!-- User cell -->
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar" style="background: {{ $avatarColor }};">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="user-name">{{ $user->name }}
                                                @if($user->id === auth()->id())
                                                    <span style="font-size:10px;color:#6366f1;font-weight:700;">(you)</span>
                                                @endif
                                            </div>
                                            <div class="user-email">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Role -->
                                <td><span class="badge badge-{{ $user->role }}">{{ ucfirst($user->role) }}</span></td>

                                <!-- Status -->
                                <td>
                                    @if($user->is_active)
                                        <span class="badge badge-active">Active</span>
                                    @else
                                        <span class="badge badge-disabled">Disabled</span>
                                    @endif
                                </td>

                                <!-- Joined -->
                                <td style="color:#64748b;">{{ $user->created_at->format('d M Y') }}</td>

                                <!-- Actions -->
                                <td>
                                    <div class="actions-cell">
                                        <!-- Change Role -->
                                        <form method="POST" action="{{ route('admin.users.updateRole', $user) }}" class="role-form">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" class="role-select">
                                                <option value="visitor"    {{ $user->role === 'visitor'    ? 'selected' : '' }}>Visitor</option>
                                                <option value="advertiser" {{ $user->role === 'advertiser' ? 'selected' : '' }}>Advertiser</option>
                                                <option value="admin"      {{ $user->role === 'admin'      ? 'selected' : '' }}>Admin</option>
                                            </select>
                                            <button type="submit" class="btn-xs btn-save">Save</button>
                                        </form>

                                        @if($user->id !== auth()->id())
                                            <!-- Toggle Status -->
                                            <form method="POST" action="{{ route('admin.users.toggleStatus', $user) }}" style="margin:0;">
                                                @csrf
                                                @method('PATCH')
                                                @if($user->is_active)
                                                    <button type="submit" class="btn-xs btn-toggle-disable">Disable</button>
                                                @else
                                                    <button type="submit" class="btn-xs btn-toggle-active">Activate</button>
                                                @endif
                                            </form>

                                            <!-- Delete -->
                                            <button type="button" class="btn-xs btn-delete"
                                                onclick="openDeleteModal('{{ $user->id }}', '{{ addslashes($user->name) }}', '{{ route('admin.users.destroy', $user) }}')">
                                                Delete
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-row">
                                <td colspan="5">No users match your search criteria.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="pagination-wrap">
                    {{ $users->links() }}
                </div>
            </div>

        </div>
    </main>
</div>

<script>
    function openDeleteModal(userId, userName, actionUrl) {
        document.getElementById('deleteUserName').textContent = userName;
        document.getElementById('deleteForm').action = actionUrl;
        document.getElementById('deleteModal').classList.add('open');
    }
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('open');
    }
    // Close on backdrop click
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });
</script>

</body>
</html>