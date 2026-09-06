<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\User;
use App\Models\Message;
use App\Notifications\AdvertisementApproved;
use App\Notifications\AdvertisementRejected;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Users metrics
        $totalUsers       = User::count();
        $totalAdvertisers = User::where('role', 'advertiser')->count();
        $totalVisitors    = User::where('role', 'visitor')->count();
        $totalAdmins      = User::where('role', 'admin')->count();
        $activeUsers      = User::where('is_active', true)->count();
        $disabledUsers    = User::where('is_active', false)->count();

        // Advertisements metrics
        $totalAds    = Advertisement::count();
        $pendingAds  = Advertisement::where('status', 'pending')->count();
        $approvedAds = Advertisement::where('status', 'approved')->count();
        $rejectedAds = Advertisement::where('status', 'rejected')->count();

        // Messages total
        $totalMessages = Message::count();

        // Recent pending advertisements for quick review
        $recentPending = Advertisement::where('status', 'pending')
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        // Recent users
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalAdvertisers', 'totalVisitors', 'totalAdmins',
            'activeUsers', 'disabledUsers',
            'totalAds', 'pendingAds', 'approvedAds', 'rejectedAds',
            'totalMessages',
            'recentPending', 'recentUsers'
        ));
    }

    public function approve(Advertisement $advertisement)
    {
        $advertisement->update(['status' => 'approved', 'rejection_reason' => null]);

        // Notify the advertiser
        $advertisement->user->notify(new AdvertisementApproved($advertisement));

        return redirect()
            ->back()
            ->with('success', 'Advertisement "' . $advertisement->title . '" has been approved!');
    }

    public function reject(Request $request, Advertisement $advertisement)
    {
        $request->validate([
            'rejection_reason' => 'required|string|min:5|max:500',
        ]);

        $advertisement->update([
            'status'           => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        // Notify the advertiser with reason
        $advertisement->user->notify(new AdvertisementRejected($advertisement, $request->rejection_reason));

        return redirect()
            ->back()
            ->with('success', 'Advertisement "' . $advertisement->title . '" has been rejected and the advertiser notified.');
    }
}
