@extends('layouts.app')

@section('title', 'Marketplace Home')

@section('content')
<div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-20">
    <div class="container mx-auto text-center">
        <h1 class="text-5xl font-extrabold mb-4">Find Anything You Need</h1>
        <p class="text-xl mb-8">Search across thousands of ads in one place.</p>
        <form action="{{ route('advertisements.index') }}" method="GET" class="max-w-xl mx-auto flex">
            <input type="text" name="search" placeholder="What are you looking for?"
                class="flex-1 px-4 py-3 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                required>
            <button type="submit"
                class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-r-md hover:bg-gray-100 transition">
                Search
            </button>
        </form>
    </div>
</div>

<div class="container mx-auto py-12">
    <h2 class="text-3xl font-bold text-center mb-8">Popular Categories</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
        @foreach($categories as $name => $slug)
            <a href="{{ route('advertisements.index', ['category' => $slug]) }}"
               class="bg-white rounded-lg shadow hover:shadow-lg transition transform hover:-translate-y-1 p-6 text-center">
                <div class="text-4xl mb-2">📦</div>
                <span class="text-xl font-medium text-gray-700">{{ $name }}</span>
            </a>
        @endforeach
    </div>
</div>

<div class="container mx-auto py-12">
    <h2 class="text-3xl font-bold text-center mb-8">Latest Advertisements</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($latestAds as $ad)
            <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                @if($ad->image)
                    <img src="{{ asset('storage/' . $ad->image) }}" alt="{{ $ad->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-2">{{ $ad->title }}</h3>
                    <p class="text-gray-600 mb-2 line-clamp-3">{{ $ad->description }}</p>
                    <a href="{{ route('advertisements.show', $ad) }}"
                       class="inline-block mt-2 text-blue-600 hover:underline">View Details</a>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">No advertisements found.</p>
        @endforelse
    </div>
    <div class="text-center mt-8">
        <a href="{{ route('advertisements.index') }}"
           class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition">
            View All Advertisements
        </a>
    </div>
</div>
@endsection
