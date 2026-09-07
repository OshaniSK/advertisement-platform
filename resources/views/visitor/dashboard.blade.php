<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Visitor Dashboard | Advertisement Platform</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">

    <!-- =========================================================
         NAVIGATION BAR
    ========================================================== -->

    <nav class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">

        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">

            <!-- Logo -->

            <a href="{{ route('visitor.dashboard') }}"
               class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-xl font-bold text-white shadow-sm">
                    A
                </div>

                <div class="hidden sm:block">
                    <div class="text-lg font-bold text-slate-900">
                        Advertisement
                    </div>

                    <div class="-mt-1 text-xs font-medium text-indigo-600">
                        PLATFORM
                    </div>
                </div>

            </a>


            <!-- Desktop Navigation -->

            <div class="hidden items-center gap-7 md:flex">

                <a href="{{ route('visitor.dashboard') }}"
                   class="font-medium text-indigo-600 transition hover:text-indigo-700">
                    Home
                </a>

                <a href="{{ route('advertisements.index') }}"
                   class="font-medium text-slate-600 transition hover:text-indigo-600">
                    Browse
                </a>

                <a href="{{ route('favorites.index') }}"
                   class="font-medium text-slate-600 transition hover:text-indigo-600">
                    Favorites
                </a>

                <a href="{{ route('messages.inbox') }}"
                   class="font-medium text-slate-600 transition hover:text-indigo-600">
                    Messages
                </a>

            </div>


            <!-- Right Navigation -->

            <div class="flex items-center gap-3">

                <!-- Notification -->

                <a href="{{ route('notifications.index') }}"
                   class="relative flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-600 transition hover:bg-indigo-50 hover:text-indigo-600"
                   title="Notifications">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.8"
                         stroke="currentColor"
                         class="h-5 w-5">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M14.857 17.082a23.848 23.848 0 0 1-5.714 0m9.258-2.096a5.25 5.25 0 0 0-1.401-2.48V10.5a4.5 4.5 0 0 0-9 0v2.006a5.25 5.25 0 0 0-1.401 2.48c-.12.33.12.682.47.682h11.576c.35 0 .59-.352.47-.682ZM9.75 20.25h4.5" />

                    </svg>


                    @if($notificationCount > 0)

                        <span class="absolute -right-1 -top-1 flex h-5 min-w-5 items-center justify-center rounded-full bg-red-500 px-1 text-[10px] font-bold text-white ring-2 ring-white">
                            {{ $notificationCount > 99 ? '99+' : $notificationCount }}
                        </span>

                    @endif

                </a>


                <!-- User -->

                <div class="hidden items-center gap-2 sm:flex">

                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 font-bold text-indigo-700">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <div class="max-w-32 truncate text-sm font-semibold text-slate-700">
                        {{ $user->name }}
                    </div>

                </div>


                <!-- Logout -->

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button type="submit"
                            class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-red-50 hover:text-red-600">
                        Logout
                    </button>

                </form>

            </div>

        </div>

    </nav>


    <!-- =========================================================
         MAIN CONTENT
    ========================================================== -->

    <main>

        <!-- =====================================================
             HERO SECTION
        ====================================================== -->

        <section class="bg-gradient-to-br from-indigo-600 via-indigo-700 to-purple-700">

            <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">

                <div class="max-w-3xl">

                    <p class="mb-3 text-sm font-semibold uppercase tracking-wider text-indigo-200">
                        Advertisement Platform
                    </p>

                    <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                        Welcome back,
                        {{ $user->name }}! 👋
                    </h1>

                    <p class="mt-5 max-w-2xl text-base leading-7 text-indigo-100 sm:text-lg">
                        Find products, services and great deals from sellers on our platform.
                    </p>

                    <div class="mt-8">

                        <a href="{{ route('advertisements.index') }}"
                           class="inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3.5 font-semibold text-indigo-700 shadow-lg transition hover:-translate-y-0.5 hover:bg-indigo-50">

                            Browse Advertisements

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="2"
                                 stroke="currentColor"
                                 class="h-5 w-5">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M13.5 4.5 19.5 10.5 13.5 16.5M19 10.5H4.5" />

                            </svg>

                        </a>

                    </div>

                </div>

            </div>

        </section>


        <!-- =====================================================
             STATISTICS
        ====================================================== -->

        <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

            <div class="grid gap-5 md:grid-cols-3">


                <!-- Favorites -->

                <a href="{{ route('favorites.index') }}"
                   class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-pink-200 hover:shadow-md">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Favorites
                            </p>

                            <p class="mt-2 text-3xl font-bold text-slate-900">
                                {{ $favoriteCount }}
                            </p>

                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-pink-50 text-2xl">
                            ❤️
                        </div>

                    </div>

                    <p class="mt-4 text-sm text-slate-500 group-hover:text-pink-600">
                        View your saved advertisements →
                    </p>

                </a>


                <!-- Messages -->

                <a href="{{ route('messages.inbox') }}"
                   class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:shadow-md">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Messages
                            </p>

                            <p class="mt-2 text-3xl font-bold text-slate-900">
                                {{ $messageCount }}
                            </p>

                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-2xl">
                            💬
                        </div>

                    </div>

                    <p class="mt-4 text-sm text-slate-500 group-hover:text-blue-600">
                        Contact sellers and manage conversations →
                    </p>

                </a>


                <!-- Notifications -->

                <a href="{{ route('notifications.index') }}"
                   class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-amber-200 hover:shadow-md">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Notifications
                            </p>

                            <p class="mt-2 text-3xl font-bold text-slate-900">
                                {{ $notificationCount }}
                            </p>

                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-2xl">
                            🔔
                        </div>

                    </div>

                    <p class="mt-4 text-sm text-slate-500 group-hover:text-amber-600">
                        View your latest notifications →
                    </p>

                </a>

            </div>

        </section>


        <!-- =====================================================
             BROWSE ADVERTISEMENTS
        ====================================================== -->

        <section class="mx-auto max-w-7xl px-4 pb-10 sm:px-6 lg:px-8">

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

                <div class="flex flex-col items-start justify-between gap-5 p-6 sm:flex-row sm:items-center sm:p-8">

                    <div class="flex items-start gap-4">

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-2xl">
                            🔍
                        </div>

                        <div>

                            <h2 class="text-xl font-bold text-slate-900">
                                Browse Advertisements
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Find products, services and great deals.
                            </p>

                        </div>

                    </div>

                    <a href="{{ route('advertisements.index') }}"
                       class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white transition hover:bg-indigo-700">

                        Browse Now

                        <span>→</span>

                    </a>

                </div>

            </div>

        </section>


        <!-- =====================================================
             RECENTLY ADDED ADVERTISEMENTS
        ====================================================== -->

        <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

            <div class="mb-7 flex items-end justify-between">

                <div>

                    <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">
                        Explore
                    </p>

                    <h2 class="mt-1 text-2xl font-bold text-slate-900 sm:text-3xl">
                        Recently Added Advertisements
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Discover the latest approved advertisements.
                    </p>

                </div>

                <a href="{{ route('advertisements.index') }}"
                   class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-700 sm:block">
                    View all →
                </a>

            </div>


            @if($recentAdvertisements->count() > 0)

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                    @foreach($recentAdvertisements as $advertisement)

                        <a href="{{ route('advertisements.show', $advertisement) }}"
                           class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">


                            <!-- Advertisement Image -->

                            <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">

                                @php
                                    $firstImage = $advertisement->images->first();
                                @endphp


                                @if($firstImage)

                                    <img
                                        src="{{ asset('storage/' . $firstImage->image) }}"
                                        alt="{{ $advertisement->title }}"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                    >

                                @elseif($advertisement->image)

                                    <img
                                        src="{{ asset('storage/' . $advertisement->image) }}"
                                        alt="{{ $advertisement->title }}"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                    >

                                @else

                                    <div class="flex h-full items-center justify-center text-slate-400">

                                        <div class="text-center">

                                            <div class="text-4xl">
                                                📷
                                            </div>

                                            <p class="mt-2 text-sm">
                                                No image
                                            </p>

                                        </div>

                                    </div>

                                @endif


                                <!-- Category Badge -->

                                <div class="absolute left-3 top-3">

                                    <span class="rounded-full bg-white/95 px-3 py-1 text-xs font-semibold text-indigo-700 shadow-sm backdrop-blur">

                                        {{ $advertisement->category }}

                                    </span>

                                </div>


                                <!-- Multiple Images Indicator -->

                                @if($advertisement->images->count() > 1)

                                    <div class="absolute bottom-3 right-3 rounded-full bg-black/70 px-3 py-1 text-xs font-medium text-white backdrop-blur">

                                        📷 {{ $advertisement->images->count() }}

                                    </div>

                                @endif

                            </div>


                            <!-- Advertisement Information -->

                            <div class="p-5">

                                <h3 class="line-clamp-1 text-lg font-bold text-slate-900 transition group-hover:text-indigo-600">

                                    {{ $advertisement->title }}

                                </h3>


                                <div class="mt-3">

                                    <p class="text-xl font-extrabold text-indigo-600">

                                        Rs. {{ number_format((float) $advertisement->price, 2) }}

                                    </p>

                                </div>


                                <div class="mt-3 flex items-center gap-2 text-sm text-slate-500">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.7"
                                         stroke="currentColor"
                                         class="h-4 w-4 shrink-0">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M19.5 10.5c0 7.142-7.5 10.5-7.5 10.5S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />

                                    </svg>

                                    <span class="truncate">
                                        {{ $advertisement->location }}
                                    </span>

                                </div>


                                <div class="mt-4 border-t border-slate-100 pt-4 text-xs text-slate-400">

                                    Posted {{ $advertisement->created_at->diffForHumans() }}

                                </div>

                            </div>

                        </a>

                    @endforeach

                </div>

            @else

                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center">

                    <div class="text-5xl">
                        📭
                    </div>

                    <h3 class="mt-4 text-lg font-bold text-slate-900">
                        No advertisements yet
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        There are currently no approved advertisements available.
                    </p>

                    <a href="{{ route('advertisements.index') }}"
                       class="mt-5 inline-flex rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700">

                        Browse Advertisements

                    </a>

                </div>

            @endif

        </section>


        <!-- =====================================================
             HOW IT WORKS
        ====================================================== -->

        <section class="bg-white py-16">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="mx-auto max-w-2xl text-center">

                    <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">
                        Simple & Easy
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        How It Works
                    </h2>

                    <p class="mt-3 text-slate-500">
                        Find what you need and connect with sellers in just a few simple steps.
                    </p>

                </div>


                <div class="mt-12 grid gap-10 md:grid-cols-3">


                    <!-- Step 1 -->

                    <div class="text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-indigo-100 text-2xl">
                            🔍
                        </div>

                        <div class="mt-5 text-sm font-bold text-indigo-600">
                            STEP 01
                        </div>

                        <h3 class="mt-2 text-xl font-bold text-slate-900">
                            Find
                        </h3>

                        <p class="mx-auto mt-2 max-w-xs text-sm leading-6 text-slate-500">
                            Browse advertisements and find products or services that interest you.
                        </p>

                    </div>


                    <!-- Step 2 -->

                    <div class="text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-pink-100 text-2xl">
                            ❤️
                        </div>

                        <div class="mt-5 text-sm font-bold text-pink-600">
                            STEP 02
                        </div>

                        <h3 class="mt-2 text-xl font-bold text-slate-900">
                            Save
                        </h3>

                        <p class="mx-auto mt-2 max-w-xs text-sm leading-6 text-slate-500">
                            Save your favorite advertisements so you can easily find them later.
                        </p>

                    </div>


                    <!-- Step 3 -->

                    <div class="text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-2xl">
                            💬
                        </div>

                        <div class="mt-5 text-sm font-bold text-blue-600">
                            STEP 03
                        </div>

                        <h3 class="mt-2 text-xl font-bold text-slate-900">
                            Contact
                        </h3>

                        <p class="mx-auto mt-2 max-w-xs text-sm leading-6 text-slate-500">
                            Contact the seller directly and discuss the advertisement with them.
                        </p>

                    </div>

                </div>

            </div>

        </section>

    </main>


    <!-- =========================================================
         FOOTER
    ========================================================== -->

    <footer class="border-t border-slate-200 bg-slate-900">

        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

            <div class="flex flex-col items-center justify-between gap-5 text-center sm:flex-row sm:text-left">

                <div>

                    <div class="font-bold text-white">
                        Advertisement Platform
                    </div>

                    <p class="mt-1 text-sm text-slate-400">
                        Find products, services and great deals.
                    </p>

                </div>


                <div class="text-sm text-slate-400">

                    © {{ date('Y') }} Advertisement Platform.
                    All rights reserved.

                </div>

            </div>

        </div>

    </footer>

</body>

</html>