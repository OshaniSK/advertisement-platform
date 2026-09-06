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

            // Keep old single image field
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            // Multiple images
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload Main Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store(
                'advertisements',
                'public'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Create Advertisement
        |--------------------------------------------------------------------------
        */

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        // Remove images from validated data before creating advertisement
        unset($validated['images']);

        $advertisement = Advertisement::create($validated);

        /*
        |--------------------------------------------------------------------------
        | Upload Multiple Images
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $index => $image) {

                $path = $image->store(
                    'advertisements',
                    'public'
                );

                $advertisement->images()->create([
                    'image' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()
            ->route('advertiser.dashboard')
            ->with(
                'success',
                'Advertisement submitted successfully!'
            );
    }

    /**
     * Display approved advertisements.
     */
    public function index(Request $request)
    {
        $query = Advertisement::where('status', 'approved');

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');

            });
        }

        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        /*
        |--------------------------------------------------------------------------
        | Location Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        /*
        |--------------------------------------------------------------------------
        | Minimum Price
        |--------------------------------------------------------------------------
        */

        if ($request->filled('min_price')) {
            $query->where(
                'price',
                '>=',
                $request->min_price
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Maximum Price
        |--------------------------------------------------------------------------
        */

        if ($request->filled('max_price')) {
            $query->where(
                'price',
                '<=',
                $request->max_price
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $advertisements = $query
            ->with('images')
            ->latest()
            ->paginate(9)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $categories = Advertisement::where(
            'status',
            'approved'
        )
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        /*
        |--------------------------------------------------------------------------
        | Locations
        |--------------------------------------------------------------------------
        */

        $locations = Advertisement::where(
            'status',
            'approved'
        )
            ->whereNotNull('location')
            ->distinct()
            ->pluck('location');

        return view(
            'advertisements.index',
            compact(
                'advertisements',
                'categories',
                'locations'
            )
        );
    }

    /**
     * Display a single advertisement.
     */
    public function show(Advertisement $advertisement)
    {
    if ($advertisement->status !== 'approved') {
        abort(404);
    }

    $advertisement->load([
        'user',
        'images'
    ]);

    return view('advertisements.show', compact('advertisement'));
    }

    /**
     * Show the edit advertisement form.
     */
    public function edit(Advertisement $advertisement)
    {
        // Only owner can edit
        if ($advertisement->user_id !== auth()->id()) {
            abort(403);
        }

        // Load multiple images
        $advertisement->load('images');

        return view(
            'advertisements.edit',
            compact('advertisement')
        );
    }

    /**
     * Update an advertisement.
     */
    public function update(
        Request $request,
        Advertisement $advertisement
    ) {
        // Only owner can update
        if ($advertisement->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',

            // Existing main image
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            // New multiple images
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Replace Main Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if ($advertisement->image) {

                Storage::disk('public')->delete(
                    $advertisement->image
                );
            }

            $validated['image'] =
                $request->file('image')->store(
                    'advertisements',
                    'public'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Update Advertisement
        |--------------------------------------------------------------------------
        */

        unset($validated['images']);

        $advertisement->update($validated);

        /*
        |--------------------------------------------------------------------------
        | Add New Multiple Images
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('images')) {

            $currentImageCount =
                $advertisement->images()->count();

            foreach (
                $request->file('images')
                as $index => $image
            ) {

                if ($currentImageCount >= 10) {
                    break;
                }

                $path = $image->store(
                    'advertisements',
                    'public'
                );

                $advertisement->images()->create([
                    'image' =>
                        $path,

                    'sort_order' =>
                        $currentImageCount + $index,
                ]);

                $currentImageCount++;
            }
        }

        return redirect()
            ->route('advertiser.dashboard')
            ->with(
                'success',
                'Advertisement updated successfully!'
            );
    }

    /**
     * Delete an advertisement.
     */
    public function destroy(
        Advertisement $advertisement
    ) {
        // Only owner can delete
        if ($advertisement->user_id !== auth()->id()) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Main Image
        |--------------------------------------------------------------------------
        */

        if ($advertisement->image) {

            Storage::disk('public')->delete(
                $advertisement->image
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Multiple Images
        |--------------------------------------------------------------------------
        */

        foreach ($advertisement->images as $image) {

            Storage::disk('public')->delete(
                $image->image
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Advertisement
        |--------------------------------------------------------------------------
        */

        $advertisement->delete();

        return redirect()
            ->route('advertiser.dashboard')
            ->with(
                'success',
                'Advertisement deleted successfully!'
            );
    }
}