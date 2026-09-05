<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Show the user's favorite advertisements.
     */
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())
            ->with('advertisement')
            ->latest()
            ->paginate(9);

        return view('favorites.index', compact('favorites'));
    }

    /**
     * Add an advertisement to favorites.
     */
    public function store(Advertisement $advertisement)
    {
        if ($advertisement->status !== 'approved') {
            abort(404);
        }

        $alreadyFavorite = Favorite::where('user_id', Auth::id())
            ->where('advertisement_id', $advertisement->id)
            ->exists();

        if (!$alreadyFavorite) {
            Favorite::create([
                'user_id' => Auth::id(),
                'advertisement_id' => $advertisement->id,
            ]);
        }

        return back()->with(
            'success',
            'Advertisement added to favorites!'
        );
    }

    /**
     * Remove an advertisement from favorites.
     */
    public function destroy(Advertisement $advertisement)
    {
        Favorite::where('user_id', Auth::id())
            ->where('advertisement_id', $advertisement->id)
            ->delete();

        return back()->with(
            'success',
            'Advertisement removed from favorites.'
        );
    }
}