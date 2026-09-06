<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Notifications\AdvertisementApproved;
use App\Notifications\AdvertisementRejected;
use Illuminate\Http\Request;

class AdminAdvertisementController extends Controller
{
    public function index(Request $request)
    {
        $query = Advertisement::with('user');

        // Filter by status tab
        $status = $request->get('status', 'pending');
        if (in_array($status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $status);
        }

        // Search by title or advertiser name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $advertisements = $query->latest()->paginate(15)->withQueryString();

        // Counts per tab for badges
        $counts = [
            'pending'  => Advertisement::where('status', 'pending')->count(),
            'approved' => Advertisement::where('status', 'approved')->count(),
            'rejected' => Advertisement::where('status', 'rejected')->count(),
        ];

        $categories = Advertisement::distinct()->pluck('category')->sort()->values();

        return view('admin.advertisements.index', compact('advertisements', 'counts', 'status', 'categories'));
    }

    public function approve(Advertisement $advertisement)
    {
        $advertisement->update(['status' => 'approved', 'rejection_reason' => null]);
        $advertisement->user->notify(new AdvertisementApproved($advertisement));

        return redirect()
            ->back()
            ->with('success', '"' . $advertisement->title . '" approved and advertiser notified.');
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

        $advertisement->user->notify(new AdvertisementRejected($advertisement, $request->rejection_reason));

        return redirect()
            ->back()
            ->with('success', '"' . $advertisement->title . '" rejected and advertiser notified.');
    }

    public function destroy(Advertisement $advertisement)
    {
        $title = $advertisement->title;
        $advertisement->delete();

        return redirect()
            ->back()
            ->with('success', '"' . $title . '" has been permanently deleted.');
    }
}
