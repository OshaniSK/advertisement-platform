<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Visitor Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Welcome Section --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">

                    <h1 class="text-2xl font-bold text-gray-800 mb-2">
                        Welcome, {{ auth()->user()->name }}! 👋
                    </h1>

                    <p class="text-gray-600">
                        Browse advertisements, save your favorite items,
                        and contact sellers.
                    </p>

                </div>
            </div>


            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif


            {{-- Dashboard Actions --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

                {{-- Browse Advertisements --}}
                <div class="bg-white rounded-lg shadow-sm p-6">

                    <div class="text-4xl mb-4">
                        🔍
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        Browse Advertisements
                    </h3>

                    <p class="text-gray-600 text-sm mb-5">
                        Find products and services posted by sellers.
                    </p>

                    <a href="{{ route('advertisements.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">

                        Browse Advertisements

                    </a>

                </div>


                {{-- Favorites --}}
                <div class="bg-white rounded-lg shadow-sm p-6">

                    <div class="text-4xl mb-4">
                        ❤️
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        My Favorites
                    </h3>

                    <p class="text-gray-600 text-sm mb-5">
                        View advertisements that you have saved.
                    </p>

                    <a href="{{ route('favorites.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition">

                        View Favorites

                    </a>

                </div>


                {{-- Messages --}}
                <div class="bg-white rounded-lg shadow-sm p-6">

                    <div class="text-4xl mb-4">
                        💬
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        My Messages
                    </h3>

                    <p class="text-gray-600 text-sm mb-5">
                        Communicate with advertisement sellers.
                    </p>

                    <a href="{{ route('messages.inbox') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">

                        View Messages

                        @if(isset($unreadMessages) && $unreadMessages > 0)

                            <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">

                                {{ $unreadMessages }}

                            </span>

                        @endif

                    </a>

                </div>

            </div>


            {{-- Quick Information --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h2 class="text-xl font-semibold text-gray-800 mb-4">
                        How It Works
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        {{-- Step 1 --}}
                        <div class="flex items-start">

                            <div class="flex-shrink-0 w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold">
                                1
                            </div>

                            <div class="ml-4">

                                <h3 class="font-semibold text-gray-800">
                                    Find an Advertisement
                                </h3>

                                <p class="text-sm text-gray-600 mt-1">
                                    Search and browse approved advertisements
                                    from sellers.
                                </p>

                            </div>

                        </div>


                        {{-- Step 2 --}}
                        <div class="flex items-start">

                            <div class="flex-shrink-0 w-10 h-10 bg-red-100 text-red-600 rounded-full flex items-center justify-center font-bold">
                                2
                            </div>

                            <div class="ml-4">

                                <h3 class="font-semibold text-gray-800">
                                    Save Your Favorites
                                </h3>

                                <p class="text-sm text-gray-600 mt-1">
                                    Save advertisements that you may want
                                    to check later.
                                </p>

                            </div>

                        </div>


                        {{-- Step 3 --}}
                        <div class="flex items-start">

                            <div class="flex-shrink-0 w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold">
                                3
                            </div>

                            <div class="ml-4">

                                <h3 class="font-semibold text-gray-800">
                                    Contact the Seller
                                </h3>

                                <p class="text-sm text-gray-600 mt-1">
                                    Send a message to the seller and discuss
                                    the advertisement.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>