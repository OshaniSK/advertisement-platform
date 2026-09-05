<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Browse Advertisements</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f3f4f6;
            color: #111827;
        }

        /* =========================
           HEADER
        ========================= */

        .header {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-inner {
            max-width: 1250px;
            margin: auto;
            padding: 16px 25px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            text-decoration: none;
            font-size: 22px;
            font-weight: 800;
            color: #111827;
        }

        .logo span {
            color: #2563eb;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-link {
            text-decoration: none;
            color: #374151;
            font-size: 14px;
            font-weight: 600;
            padding: 9px 13px;
            border-radius: 7px;
        }

        .header-link:hover {
            background: #f3f4f6;
        }

        .login-button {
            background: #2563eb;
            color: white;
        }

        .login-button:hover {
            background: #1d4ed8;
        }

        /* =========================
           MAIN
        ========================= */

        .container {
            max-width: 1250px;
            margin: auto;
            padding: 35px 25px 60px;
        }

        /* =========================
           HERO
        ========================= */

        .hero {
            background: linear-gradient(
                135deg,
                #1d4ed8,
                #2563eb
            );

            color: white;

            border-radius: 16px;

            padding: 38px;

            margin-bottom: 25px;

            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.18);
        }

        .hero h1 {
            margin: 0 0 10px;
            font-size: 34px;
        }

        .hero p {
            margin: 0;
            color: #dbeafe;
            font-size: 16px;
        }

        /* =========================
           FILTER BOX
        ========================= */

        .filter-box {
            background: white;

            padding: 22px;

            border-radius: 14px;

            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);

            margin-bottom: 30px;
        }

        .filter-title {
            margin: 0 0 18px;

            font-size: 17px;

            font-weight: 700;

            color: #111827;
        }

        .search-row {
            display: grid;

            grid-template-columns:
                2fr 1fr 1fr;

            gap: 12px;

            margin-bottom: 15px;
        }

        .price-row {
            display: grid;

            grid-template-columns:
                1fr 1fr auto auto;

            gap: 12px;

            align-items: end;
        }

        .filter-label {
            display: block;

            font-size: 12px;

            font-weight: 700;

            color: #374151;

            margin-bottom: 6px;
        }

        input,
        select {
            width: 100%;

            padding: 12px;

            border: 1px solid #d1d5db;

            border-radius: 8px;

            font-size: 14px;

            background: white;
        }

        input:focus,
        select:focus {
            outline: none;

            border-color: #2563eb;

            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        .button {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 12px 20px;

            border-radius: 8px;

            border: none;

            cursor: pointer;

            text-decoration: none;

            font-size: 14px;

            font-weight: 700;

            min-height: 44px;
        }

        .search-button {
            background: #2563eb;

            color: white;
        }

        .search-button:hover {
            background: #1d4ed8;
        }

        .clear-button {
            background: #f3f4f6;

            color: #374151;
        }

        .clear-button:hover {
            background: #e5e7eb;
        }

        /* =========================
           RESULTS HEADER
        ========================= */

        .results-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 18px;
        }

        .results-header h2 {
            margin: 0;

            font-size: 21px;
        }

        .result-count {
            color: #6b7280;

            font-size: 14px;
        }

        /* =========================
           ADVERTISEMENT GRID
        ========================= */

        .advertisement-grid {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 22px;
        }

        /* =========================
           CARD
        ========================= */

        .card {
            background: white;

            border-radius: 14px;

            overflow: hidden;

            box-shadow:
                0 3px 15px rgba(0, 0, 0, 0.06);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;

            border: 1px solid #f0f0f0;
        }

        .card:hover {
            transform: translateY(-5px);

            box-shadow:
                0 12px 30px rgba(0, 0, 0, 0.10);
        }

        /* =========================
           IMAGE
        ========================= */

        .card-image {
            width: 100%;

            height: 230px;

            background: #f3f4f6;

            display: flex;

            align-items: center;

            justify-content: center;

            overflow: hidden;

            position: relative;
        }

        .card-image img {
            width: 100%;

            height: 100%;

            object-fit: cover;

            transition: transform 0.3s ease;
        }

        .card:hover .card-image img {
            transform: scale(1.04);
        }

        .no-image {
            color: #9ca3af;

            font-size: 14px;
        }

        /* =========================
           CARD CONTENT
        ========================= */

        .card-content {
            padding: 18px;
        }

        .category {
            display: inline-block;

            background: #eff6ff;

            color: #1d4ed8;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: 700;

            margin-bottom: 10px;
        }

        .card-title {
            font-size: 18px;

            font-weight: 700;

            color: #111827;

            margin: 0 0 9px;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }

        .price {
            font-size: 21px;

            font-weight: 800;

            color: #111827;

            margin-bottom: 9px;
        }

        .location {
            color: #6b7280;

            font-size: 13px;

            margin-bottom: 12px;
        }

        .description {
            color: #6b7280;

            font-size: 13px;

            line-height: 1.5;

            height: 40px;

            overflow: hidden;

            margin-bottom: 16px;
        }

        .view-button {
            display: block;

            width: 100%;

            text-align: center;

            background: #2563eb;

            color: white;

            padding: 11px;

            border-radius: 8px;

            text-decoration: none;

            font-size: 14px;

            font-weight: 700;

            transition: background 0.2s;
        }

        .view-button:hover {
            background: #1d4ed8;
        }

        /* =========================
           EMPTY STATE
        ========================= */

        .empty {
            background: white;

            padding: 60px 20px;

            text-align: center;

            border-radius: 14px;

            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
        }

        .empty-icon {
            font-size: 45px;

            margin-bottom: 12px;
        }

        .empty h3 {
            margin: 0 0 8px;

            font-size: 20px;
        }

        .empty p {
            color: #6b7280;

            margin-bottom: 20px;
        }

        /* =========================
           PAGINATION
        ========================= */

        .pagination {
            margin-top: 35px;

            display: flex;

            justify-content: center;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 950px) {

            .advertisement-grid {
                grid-template-columns:
                    repeat(2, 1fr);
            }

            .search-row {
                grid-template-columns:
                    1fr 1fr;
            }

            .price-row {
                grid-template-columns:
                    1fr 1fr;
            }

        }

        @media (max-width: 650px) {

            .header-inner {
                padding: 14px 18px;

                flex-direction: column;

                align-items: flex-start;

                gap: 12px;
            }

            .nav-links {
                width: 100%;

                flex-wrap: wrap;
            }

            .container {
                padding: 25px 15px 50px;
            }

            .hero {
                padding: 28px 22px;
            }

            .hero h1 {
                font-size: 27px;
            }

            .search-row,
            .price-row {
                grid-template-columns:
                    1fr;
            }

            .advertisement-grid {
                grid-template-columns:
                    1fr;
            }

            .results-header {
                flex-direction: column;

                align-items: flex-start;

                gap: 5px;
            }

        }

    </style>

</head>


<body>


<!-- =========================
     HEADER
========================= -->

<header class="header">

    <div class="header-inner">

        <a
            href="{{ route('advertisements.index') }}"
            class="logo"
        >
            Advertisement <span>Platform</span>
        </a>


        <div class="nav-links">

            @auth

                @if (auth()->user()->role === 'advertiser')

                    <a
                        href="{{ route('advertiser.dashboard') }}"
                        class="header-link"
                    >
                        My Dashboard
                    </a>

                    <a
                        href="{{ route('messages.inbox') }}"
                        class="header-link"
                    >
                        💬 Messages
                    </a>

                @elseif (auth()->user()->role === 'visitor')

                    <a
                        href="{{ route('visitor.dashboard') }}"
                        class="header-link"
                    >
                        My Dashboard
                    </a>

                    <a
                        href="{{ route('messages.inbox') }}"
                        class="header-link"
                    >
                        💬 Messages
                    </a>

                @elseif (auth()->user()->role === 'admin')

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="header-link"
                    >
                        Admin Dashboard
                    </a>

                @endif

            @else

                <a
                    href="{{ route('login') }}"
                    class="header-link"
                >
                    Login
                </a>

                <a
                    href="{{ route('register') }}"
                    class="header-link login-button"
                >
                    Register
                </a>

            @endauth

        </div>

    </div>

</header>


<!-- =========================
     MAIN
========================= -->

<main class="container">


    <!-- =========================
         HERO
    ========================= -->

    <section class="hero">

        <h1>
            Find What You Need
        </h1>

        <p>
            Discover great products and services from sellers.
        </p>

    </section>


    <!-- =========================
         FILTERS
    ========================= -->

    <section class="filter-box">

        <h2 class="filter-title">
            🔎 Search & Filter
        </h2>


        <form
            method="GET"
            action="{{ route('advertisements.index') }}"
        >


            <!-- SEARCH / CATEGORY / LOCATION -->

            <div class="search-row">


                <div>

                    <label
                        class="filter-label"
                        for="search"
                    >
                        Search
                    </label>

                    <input
                        type="text"
                        id="search"
                        name="search"
                        placeholder="What are you looking for?"
                        value="{{ request('search') }}"
                    >

                </div>


                <div>

                    <label
                        class="filter-label"
                        for="category"
                    >
                        Category
                    </label>

                    <select
                        name="category"
                        id="category"
                    >

                        <option value="">
                            All Categories
                        </option>

                        @foreach ($categories as $category)

                            <option
                                value="{{ $category }}"
                                {{ request('category') == $category ? 'selected' : '' }}
                            >
                                {{ $category }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div>

                    <label
                        class="filter-label"
                        for="location"
                    >
                        Location
                    </label>

                    <select
                        name="location"
                        id="location"
                    >

                        <option value="">
                            All Locations
                        </option>

                        @foreach ($locations as $location)

                            <option
                                value="{{ $location }}"
                                {{ request('location') == $location ? 'selected' : '' }}
                            >
                                {{ $location }}
                            </option>

                        @endforeach

                    </select>

                </div>


            </div>


            <!-- PRICE -->

            <div class="price-row">


                <div>

                    <label
                        class="filter-label"
                        for="min_price"
                    >
                        Minimum Price
                    </label>

                    <input
                        type="number"
                        name="min_price"
                        id="min_price"
                        min="0"
                        placeholder="Rs. 0"
                        value="{{ request('min_price') }}"
                    >

                </div>


                <div>

                    <label
                        class="filter-label"
                        for="max_price"
                    >
                        Maximum Price
                    </label>

                    <input
                        type="number"
                        name="max_price"
                        id="max_price"
                        min="0"
                        placeholder="Rs. 100000"
                        value="{{ request('max_price') }}"
                    >

                </div>


                <button
                    type="submit"
                    class="button search-button"
                >
                    🔍 Search
                </button>


                <a
                    href="{{ route('advertisements.index') }}"
                    class="button clear-button"
                >
                    Clear
                </a>


            </div>


        </form>

    </section>


    <!-- =========================
         RESULTS HEADER
    ========================= -->

    <div class="results-header">

        <h2>
            Latest Advertisements
        </h2>

        <span class="result-count">

            {{ $advertisements->total() }}

            advertisement(s)

        </span>

    </div>


    <!-- =========================
         ADVERTISEMENTS
    ========================= -->

    @if ($advertisements->count() > 0)


        <div class="advertisement-grid">


    @foreach ($advertisements as $advertisement)


         <article class="card">
                 @if (auth()->check())
    @php
        $isFavorite = \App\Models\Favorite::where('user_id', auth()->id())
            ->where('advertisement_id', $advertisement->id)
            ->exists();
    @endphp

    <div style="text-align: right; padding: 12px 15px 0;">
        @if ($isFavorite)

            <form
                action="{{ route('favorites.destroy', $advertisement) }}"
                method="POST"
                style="display: inline;"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    style="
                        border: none;
                        background: #fee2e2;
                        color: #dc2626;
                        border-radius: 50%;
                        width: 40px;
                        height: 40px;
                        font-size: 20px;
                        cursor: pointer;
                    "
                    title="Remove from favorites"
                >
                    ❤️
                </button>
            </form>

        @else

            <form
                action="{{ route('favorites.store', $advertisement) }}"
                method="POST"
                style="display: inline;"
            >
                @csrf

                <button
                    type="submit"
                    style="
                        border: 1px solid #d1d5db;
                        background: white;
                        color: #6b7280;
                        border-radius: 50%;
                        width: 40px;
                        height: 40px;
                        font-size: 20px;
                        cursor: pointer;
                    "
                    title="Add to favorites"
                >
                    ♡
                </button>
            </form>

        @endif
    </div>
@endif


                    <!-- IMAGE -->

                    <div class="card-image">

                        @if ($advertisement->image)

                            <img
                                src="{{ asset('storage/' . $advertisement->image) }}"
                                alt="{{ $advertisement->title }}"
                            >

                        @else

                            <span class="no-image">
                                📷 No Image Available
                            </span>

                        @endif

                    </div>


                    <!-- CONTENT -->

                    <div class="card-content">


                        @if ($advertisement->category)

                            <span class="category">

                                {{ $advertisement->category }}

                            </span>

                        @endif


                        <h3 class="card-title">

                            {{ $advertisement->title }}

                        </h3>


                        @if ($advertisement->price !== null)

                            <div class="price">

                                Rs.
                                {{ number_format($advertisement->price, 2) }}

                            </div>

                        @else

                            <div class="price">

                                Price not specified

                            </div>

                        @endif


                        @if ($advertisement->location)

                            <div class="location">

                                📍 {{ $advertisement->location }}

                            </div>

                        @endif


                        <div class="description">

                            {{ $advertisement->description }}

                        </div>


                        <a
                            href="{{ route('advertisements.show', $advertisement) }}"
                            class="view-button"
                        >
                            View Details →
                        </a>


                    </div>


                </article>


            @endforeach


        </div>


        <!-- =========================
             PAGINATION
        ========================= -->

        <div class="pagination">

            {{ $advertisements->links() }}

        </div>


    @else


        <!-- =========================
             EMPTY STATE
        ========================= -->

        <div class="empty">

            <div class="empty-icon">
                🔍
            </div>

            <h3>
                No advertisements found
            </h3>

            <p>
                No advertisements match your search or filters.
            </p>

            <a
                href="{{ route('advertisements.index') }}"
                class="button clear-button"
            >
                Clear Filters
            </a>

        </div>


    @endif


</main>


</body>

</html>