<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->filled('role') && in_array($request->role, ['admin', 'advertiser', 'visitor'])) {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $users = $query->latest()->paginate(20)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,advertiser,visitor',
        ]);

        $user->update(['role' => $request->role]);

        return redirect()
            ->back()
            ->with('success', 'Role updated for ' . $user->name . '.');
    }

    public function toggleStatus(User $user)
    {
        // Prevent disabling own account
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot disable your own account.');
        }

        $user->update(['is_active' => ! $user->is_active]);

        $label = $user->is_active ? 'activated' : 'disabled';

        return redirect()
            ->back()
            ->with('success', $user->name . ' has been ' . $label . '.');
    }

    public function destroy(User $user)
    {
        // Prevent deleting own account
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }

        $name = $user->name;
        $user->delete();

        return redirect()
            ->back()
            ->with('success', $user->name . ' has been deleted.');
    }
}