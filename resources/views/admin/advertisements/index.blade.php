<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertisement Management — Admin</title>
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

        /* TABS */
        .tabs { display: flex; gap: 4px; margin-bottom: 24px; background: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 6px; width: fit-content; }
        .tab-btn {
            display: flex; align-items: center; gap: 8px; padding: 10px 18px; border-radius: 8px;
            font-size: 14px; font-weight: 600; text-decoration: none; color: #64748b;
            transition: 0.15s; white-space: nowrap;
        }
        .tab-btn:hover { color: #f1f5f9; background: #334155; }
        .tab-btn.active-pending  { background: #451a03; color: #fbbf24; }
        .tab-btn.active-approved { background: #052e16; color: #4ade80; }
        .tab-btn.active-rejected { background: #4c0519; color: #fda4af; }
        .tab-count { font-size: 11px; font-weight: 800; padding: 2px 7px; border-radius: 10px; background: rgba(255,255,255,0.1); }

        /* FILTER BAR */
        .filter-bar { background: #1e293b; border: 1px solid #334155; border-radius: 14px; padding: 18px 22px; display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap; margin-bottom: 24px; }
        .filter-group { display: flex; flex-direction: column; gap: 6px; }
        .filter-group label { font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
        .filter-input, .filter-select { background: #0f172a; border: 1px solid #334155; color: #e2e8f0; border-radius: 8px; padding: 9px 14px; font-size: 14px; font-family: inherit; outline: none; transition: 0.15s; }
        .filter-input { min-width: 260px; }
        .filter-select { min-width: 150px; cursor: pointer; }
        .filter-input:focus, .filter-select:focus { border-color: #6366f1; }
        .filter-btn { padding: 9px 18px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; font-weight: 700; font-family: inherit; transition: 0.15s; }
        .btn-primary { background: #4f46e5; color: white; }
        .btn-primary:hover { background: #4338ca; }
        .btn-ghost { background: #334155; color: #94a3b8; text-decoration: none; display: inline-block; }
        .btn-ghost:hover { background: #475569; color: #f1f5f9; }

        /* TABLE */
        .table-card { background: #1e293b; border: 1px solid #334155; border-radius: 14px; overflow: hidden; }
        .table-header { padding: 18px 22px; border-bottom: 1px solid #334155; display: flex; align-items: center; justify-content: space-between; }
        .table-header h3 { font-size: 15px; font-weight: 700; color: #f1f5f9; }
        .count-badge { background: #334155; color: #94a3b8; font-size: 12px; font-weight: 700; padding: 3px 10px; border-radius: 20px; }

        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { padding: 11px 16px; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; text-align: left; border-bottom: 1px solid #334155; background: #172033; }
        .data-table td { padding: 14px 16px; font-size: 13px; color: #cbd5e1; border-bottom: 1px solid #0f172a; vertical-align: middle; }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: #131f30; }

        .ad-cell { display: flex; align-items: center; gap: 12px; }
        .ad-thumb { width: 48px; height: 48px; border-radius: 8px; object-fit: cover; flex-shrink: 0; background: #334155; }
        .ad-thumb-placeholder { width: 48px; height: 48px; border-radius: 8px; background: #334155; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
        .ad-title { font-weight: 600; color: #f1f5f9; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .ad-category { font-size: 11px; color: #64748b; margin-top: 2px; }
        .ad-price { font-weight: 700; color: #4ade80; }

        .badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: capitalize; }
        .badge-pending  { background: #451a03; color: #fbbf24; }
        .badge-approved { background: #052e16; color: #4ade80; }
        .badge-rejected { background: #4c0519; color: #fda4af; }

        /* ACTION BUTTONS */
        .actions-cell { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
        .btn-xs { padding: 5px 10px; border-radius: 6px; border: none; cursor: pointer; font-size: 12px; font-weight: 700; font-family: inherit; transition: 0.15s; text-decoration: none; display: inline-block; }
        .btn-view   { background: #1e3a5f; color: #93c5fd; }
        .btn-view:hover   { background: #1e40af; color: white; }
        .btn-approve{ background: #052e16; color: #4ade80; border: 1px solid #166534; }
        .btn-approve:hover{ background: #14532d; }
        .btn-reject { background: #4c0519; color: #fda4af; border: 1px solid #9f1239; }
        .btn-reject:hover { background: #831843; color: #fecdd3; }
        .btn-delete { background: transparent; color: #ef4444; border: 1px solid #7f1d1d; }
        .btn-delete:hover { background: #7f1d1d; color: #fca5a5; }

        /* REJECTION REASON display */
        .rejection-note { font-size: 12px; color: #fda4af; background: #2d0a0a; border-left: 3px solid #f43f5e; padding: 6px 10px; border-radius: 4px; max-width: 220px; margin-top: 4px; }

        /* PAGINATION */
        .pagination-wrap { padding: 16px 22px; border-top: 1px solid #334155; display: flex; justify-content: flex-end; }

        /* EMPTY */
        .empty-row td { text-align: center; color: #475569; padding: 60px; }
        .empty-icon { font-size: 40px; margin-bottom: 12px; }

        /* ===== REJECT MODAL ===== */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.75); z-index: 200; align-items: center; justify-content: center; }
        .modal-overlay.open { display: flex; }
        .modal { background: #1e293b; border: 1px solid #334155; border-radius: 16px; padding: 32px; max-width: 480px; width: 90%; }
        .modal h3 { font-size: 18px; font-weight: 800; color: #f8fafc; margin-bottom: 8px; }
        .modal-sub { color: #64748b; font-size: 13px; margin-bottom: 20px; }
        .modal-ad-title { color: #fbbf24; font-weight: 700; }
        .modal label { display: block; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
        .modal textarea {
            width: 100%; background: #0f172a; border: 1px solid #334155; color: #e2e8f0; border-radius: 8px;
            padding: 12px; font-size: 14px; font-family: inherit; outline: none; resize: vertical; min-height: 100px; transition: 0.15s;
        }
        .modal textarea:focus { border-color: #ef4444; }
        .modal-hint { font-size: 11px; color: #475569; margin-top: 6px; margin-bottom: 20px; }
        .modal-actions { display: flex; gap: 10px; justify-content: flex-end; }
        .btn-cancel { background: #334155; color: #94a3b8; padding: 10px 18px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; font-weight: 700; font-family: inherit; }
        .btn-cancel:hover { background: #475569; }
        .btn-danger { background: #dc2626; color: white; padding: 10px 18px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; font-weight: 700; font-family: inherit; }
        .btn-danger:hover { background: #b91c1c; }

        /* DELETE MODAL */
        .modal-delete { background: #1e293b; border: 1px solid #334155; border-radius: 16px; padding: 32px; max-width: 400px; width: 90%; }
        .modal-delete h3 { font-size: 18px; font-weight: 800; color: #f8fafc; margin-bottom: 10px; }
        .modal-delete p { color: #94a3b8; font-size: 14px; line-height: 1.6; margin-bottom: 24px; }

        @media (max-width: 900px) { .sidebar { display: none; } .main { margin-left: 0; } }
        @media (max-width: 600px) { .content { padding: 16px; } .topbar { padding: 14px 16px; } .tabs { flex-wrap: wrap; } }
    </style>
</head>
<body>

<!-- ===== REJECT MODAL ===== -->
<div class="modal-overlay" id="rejectModal">
    <div class="modal">
        <h3>❌ Reject Advertisement</h3>
        <p class="modal-sub">You are rejecting: <span class="modal-ad-title" id="rejectAdTitle"></span></p>
        <form id="rejectForm" method="POST">
            @csrf
            @method('PATCH')
            <label>Rejection Reason (required)</label>
            <textarea name="rejection_reason" id="rejectionReasonInput" placeholder="e.g. Image does not meet quality requirements. Please re-upload with proper lighting..." required></textarea>
            <div class="modal-hint">This reason will be sent directly to the advertiser as a notification.</div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeRejectModal()">Cancel</button>
                <button type="submit" class="btn-danger">Reject &amp; Notify Advertiser</button>
            </div>
        </form>
    </div>
</div>

<!-- ===== DELETE MODAL ===== -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal-delete">
        <h3>🗑️ Delete Advertisement</h3>
        <p>Are you sure you want to permanently delete <strong id="deleteAdTitle"></strong>? This cannot be undone.</p>
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
            <a href="{{ route('admin.users.index') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Users
            </a>
            <a href="{{ route('admin.advertisements.index') }}" class="nav-item active">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Advertisements
                @if($counts['pending'] > 0)
                    <span style="margin-left:auto;background:#451a03;color:#fbbf24;font-size:11px;padding:1px 7px;border-radius:10px;">{{ $counts['pending'] }}</span>
                @endif
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
            <h1>📋 Advertisement Moderation</h1>
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

            <!-- TABS -->
            <div class="tabs">
                <a href="{{ route('admin.advertisements.index') }}?status=pending{{ request('search') ? '&search='.request('search') : '' }}{{ request('category') ? '&category='.request('category') : '' }}"
                   class="tab-btn {{ $status === 'pending' ? 'active-pending' : '' }}">
                    ⏳ Pending
                    <span class="tab-count">{{ $counts['pending'] }}</span>
                </a>
                <a href="{{ route('admin.advertisements.index') }}?status=approved{{ request('search') ? '&search='.request('search') : '' }}{{ request('category') ? '&category='.request('category') : '' }}"
                   class="tab-btn {{ $status === 'approved' ? 'active-approved' : '' }}">
                    ✅ Approved
                    <span class="tab-count">{{ $counts['approved'] }}</span>
                </a>
                <a href="{{ route('admin.advertisements.index') }}?status=rejected{{ request('search') ? '&search='.request('search') : '' }}{{ request('category') ? '&category='.request('category') : '' }}"
                   class="tab-btn {{ $status === 'rejected' ? 'active-rejected' : '' }}">
                    ❌ Rejected
                    <span class="tab-count">{{ $counts['rejected'] }}</span>
                </a>
            </div>

            <!-- FILTER BAR -->
            <form method="GET" action="{{ route('admin.advertisements.index') }}" class="filter-bar">
                <input type="hidden" name="status" value="{{ $status }}">
                <div class="filter-group" style="flex:1;">
                    <label>Search</label>
                    <input type="text" name="search" class="filter-input" placeholder="Title or advertiser name..." value="{{ request('search') }}">
                </div>
                <div class="filter-group">
                    <label>Category</label>
                    <select name="category" class="filter-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="filter-btn btn-primary">Filter</button>
                <a href="{{ route('admin.advertisements.index') }}?status={{ $status }}" class="filter-btn btn-ghost">Reset</a>
            </form>

            <!-- TABLE -->
            <div class="table-card">
                <div class="table-header">
                    <h3>
                        @if($status === 'pending') ⏳ Pending Review
                        @elseif($status === 'approved') ✅ Approved Advertisements
                        @else ❌ Rejected Advertisements
                        @endif
                    </h3>
                    <span class="count-badge">{{ $advertisements->total() }} found</span>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Advertisement</th>
                            <th>Advertiser</th>
                            <th>Price</th>
                            <th>Location</th>
                            <th>Submitted</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($advertisements as $ad)
                            <tr>
                                <!-- Ad info -->
                                <td>
                                    <div class="ad-cell">
                                        @if($ad->image)
                                            <img src="{{ asset('storage/' . $ad->image) }}" class="ad-thumb" alt="{{ $ad->title }}">
                                        @else
                                            <div class="ad-thumb-placeholder">📦</div>
                                        @endif
                                        <div>
                                            <div class="ad-title" title="{{ $ad->title }}">{{ $ad->title }}</div>
                                            <div class="ad-category">{{ $ad->category }}</div>
                                            @if($ad->status === 'rejected' && $ad->rejection_reason)
                                                <div class="rejection-note">⚠️ {{ Str::limit($ad->rejection_reason, 60) }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- Advertiser -->
                                <td>
                                    <div style="font-weight:600;color:#f1f5f9;">{{ $ad->user->name }}</div>
                                    <div style="font-size:11px;color:#64748b;">{{ $ad->user->email }}</div>
                                </td>

                                <!-- Price -->
                                <td><span class="ad-price">LKR {{ number_format($ad->price) }}</span></td>

                                <!-- Location -->
                                <td style="color:#64748b;">{{ $ad->location ?? 'N/A' }}</td>

                                <!-- Date -->
                                <td style="color:#64748b;white-space:nowrap;">{{ $ad->created_at->format('d M Y') }}</td>

                                <!-- Status badge -->
                                <td><span class="badge badge-{{ $ad->status }}">{{ ucfirst($ad->status) }}</span></td>

                                <!-- Actions -->
                                <td>
                                    <div class="actions-cell">
                                        <!-- View -->
                                        @if($ad->status === 'approved')
                                            <a href="{{ route('advertisements.show', $ad) }}" target="_blank" class="btn-xs btn-view">View</a>
                                        @endif

                                        <!-- Approve (if pending or rejected) -->
                                        @if($ad->status !== 'approved')
                                            <form method="POST" action="{{ route('admin.advertisements.approve', $ad) }}" style="margin:0;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn-xs btn-approve">Approve</button>
                                            </form>
                                        @endif

                                        <!-- Reject (if pending or approved) -->
                                        @if($ad->status !== 'rejected')
                                            <button type="button" class="btn-xs btn-reject"
                                                onclick="openRejectModal('{{ $ad->id }}', '{{ addslashes($ad->title) }}', '{{ route('admin.advertisements.reject', $ad) }}')">
                                                Reject
                                            </button>
                                        @endif

                                        <!-- Delete -->
                                        <button type="button" class="btn-xs btn-delete"
                                            onclick="openDeleteModal('{{ $ad->id }}', '{{ addslashes($ad->title) }}', '{{ route('admin.advertisements.destroy', $ad) }}')">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-row">
                                <td colspan="7">
                                    <div class="empty-icon">
                                        @if($status === 'pending') ⏳
                                        @elseif($status === 'approved') ✅
                                        @else ❌
                                        @endif
                                    </div>
                                    No {{ $status }} advertisements found.
                                    @if($status === 'pending') <br><span style="font-size:12px;color:#334155;">All ads have been reviewed — great job!</span>@endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="pagination-wrap">
                    {{ $advertisements->links() }}
                </div>
            </div>

        </div>
    </main>
</div>

<script>
    // Reject Modal
    function openRejectModal(adId, adTitle, actionUrl) {
        document.getElementById('rejectAdTitle').textContent = '"' + adTitle + '"';
        document.getElementById('rejectForm').action = actionUrl;
        document.getElementById('rejectionReasonInput').value = '';
        document.getElementById('rejectModal').classList.add('open');
        setTimeout(() => document.getElementById('rejectionReasonInput').focus(), 100);
    }
    function closeRejectModal() {
        document.getElementById('rejectModal').classList.remove('open');
    }

    // Delete Modal
    function openDeleteModal(adId, adTitle, actionUrl) {
        document.getElementById('deleteAdTitle').textContent = '"' + adTitle + '"';
        document.getElementById('deleteForm').action = actionUrl;
        document.getElementById('deleteModal').classList.add('open');
    }
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('open');
    }

    // Close modals on backdrop click
    ['rejectModal', 'deleteModal'].forEach(function(id) {
        document.getElementById(id).addEventListener('click', function(e) {
            if (e.target === this) { this.classList.remove('open'); }
        });
    });

    // Close modals on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeRejectModal();
            closeDeleteModal();
        }
    });
</script>

</body>
</html>
