<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the marketplace homepage.
     */
    public function index()
    {
        // Popular categories – hard coded for now; can be moved to config later.
        $categories = [
            'Food' => 'food',
            'Vehicles' => 'vehicles',
            'Electronics' => 'electronics',
            'Furniture' => 'furniture',
            'Clothing' => 'clothing',
            'Services' => 'services',
        ];

        // Latest approved advertisements (limit 6 for the hero section).
        $latestAds = Advertisement::where('status', 'approved')
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('categories', 'latestAds'));
    }
}
