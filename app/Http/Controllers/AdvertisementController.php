<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

            // Advertisement image
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Upload image if provided
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store(
                'advertisements',
                'public'
            );
        }

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        Advertisement::create($validated);

        return redirect()
            ->route('advertiser.dashboard')
            ->with('success', 'Advertisement submitted successfully!');
    }

    /**
     * Display approved advertisements.
     */
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

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
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

    /**
     * Display a single advertisement.
     */
    public function show(Advertisement $advertisement)
    {
        if ($advertisement->status !== 'approved') {
            abort(404);
        }

        return view('advertisements.show', compact('advertisement'));
    }

    /**
     * Show the edit advertisement form.
     */
    public function edit(Advertisement $advertisement)
    {
        // Only the owner can edit the advertisement
        if ($advertisement->user_id !== auth()->id()) {
            abort(403);
        }

        return view('advertisements.edit', compact('advertisement'));
    }

    /**
     * Update an advertisement.
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        // Only the owner can update the advertisement
        if ($advertisement->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',

            // New image is optional
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Replace Advertisement Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            // Delete the old image
            if ($advertisement->image) {
                Storage::disk('public')->delete($advertisement->image);
            }

            // Store the new image
            $validated['image'] = $request->file('image')->store(
                'advertisements',
                'public'
            );
        }

        // Update advertisement
        $advertisement->update($validated);

        return redirect()
            ->route('advertiser.dashboard')
            ->with('success', 'Advertisement updated successfully!');
    }

    /**
     * Delete an advertisement.
     */
    public function destroy(Advertisement $advertisement)
    {
        // Only the owner can delete the advertisement
        if ($advertisement->user_id !== auth()->id()) {
            abort(403);
        }

        // Delete the image from storage
        if ($advertisement->image) {
            Storage::disk('public')->delete($advertisement->image);
        }

        // Delete the advertisement
        $advertisement->delete();

        return redirect()
            ->route('advertiser.dashboard')
            ->with('success', 'Advertisement deleted successfully!');
    }
}