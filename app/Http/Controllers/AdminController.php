<?php


namespace App\Http\Controllers;

use App\Models\Advertisement;

class AdminController extends Controller
{
    public function dashboard()
    {
        $advertisements = Advertisement::where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.dashboard', compact('advertisements'));
    }

    public function approve(Advertisement $advertisement)
    {
        $advertisement->update([
            'status' => 'approved'
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Advertisement approved successfully!');
    }

    public function reject(Advertisement $advertisement)
    {
        $advertisement->update([
            'status' => 'rejected'
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Advertisement rejected successfully!');
    }
}

