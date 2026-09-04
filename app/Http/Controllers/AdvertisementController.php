<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertisementController extends Controller
{
    /**
     * Show the create advertisement form.
     */
    public function create()
    {
        return view('advertisements.create');
    }

    /**
     * Save a new advertisement.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        Advertisement::create($validated);

        return redirect()
            ->route('advertiser.dashboard')
            ->with('success', 'Advertisement submitted successfully!');
    }
    public function index(Request $request)
{
    $query = Advertisement::where('status', 'approved');

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
              ->orWhere('description', 'like', '%' . $search . '%');
        });
    }

    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    if ($request->filled('location')) {
        $query->where('location', $request->location);
    }

    $advertisements = $query->latest()->get();

    $categories = Advertisement::where('status', 'approved')
        ->whereNotNull('category')
        ->distinct()
        ->pluck('category');

    $locations = Advertisement::where('status', 'approved')
        ->whereNotNull('location')
        ->distinct()
        ->pluck('location');

    return view('advertisements.index', compact(
        'advertisements',
        'categories',
        'locations'
    ));
}
public function show(Advertisement $advertisement)
{
    if ($advertisement->status !== 'approved') {
        abort(404);
    }

    return view('advertisements.show', compact('advertisement'));
}

public function edit(Advertisement $advertisement)
{
    if ($advertisement->user_id !== auth()->id()) {
        abort(403);
    }

    return view('advertisements.edit', compact('advertisement'));
}

public function update(Request $request, Advertisement $advertisement)
{
    if ($advertisement->user_id !== auth()->id()) {
        abort(403);
    }

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'nullable|numeric|min:0',
        'category' => 'nullable|string|max:255',
        'location' => 'nullable|string|max:255',
    ]);

    $advertisement->update($validated);

    return redirect()
        ->route('advertiser.dashboard')
        ->with('success', 'Advertisement updated successfully!');
}
public function destroy(Advertisement $advertisement)
{
    if ($advertisement->user_id !== auth()->id()) {
        abort(403);
    }

    $advertisement->delete();

    return redirect()
        ->route('advertiser.dashboard')
        ->with('success', 'Advertisement deleted successfully!');
}

}