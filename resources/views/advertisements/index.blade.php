<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Advertisements - Marketplace</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f6f8;
            color: #222;
        }

        /* ================= HEADER ================= */

        .header {
            background: #ffffff;
            border-bottom: 1px solid #ddd;
            padding: 18px 40px;
        }

        .header-inner {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #111827;
            text-decoration: none;
        }

        .header-links {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-link {
            text-decoration: none;
            color: #374151;
            font-size: 14px;
        }

        .header-link:hover {
            color: #111827;
        }

        .login-button {
            background: #111827;
            color: white;
            padding: 9px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        /* ================= MAIN ================= */

        .container {
            max-width: 1200px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .page-title {
            font-size: 32px;
            margin: 0 0 8px;
            color: #111827;
        }

        .page-subtitle {
            color: #6b7280;
            margin-bottom: 30px;
        }

        /* ================= SEARCH ================= */

        .search-box {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
            margin-bottom: 35px;
        }

        .search-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .price-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .field {
            width: 100%;
        }

        .field label {
            display: block;
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: bold;
            color: #374151;
        }

        .field input,
        .field select {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            background: white;
            font-size: 14px;
        }

        .field input:focus,
        .field select:focus {
            outline: none;
            border-color: #2563eb;
        }

        .search-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .search-button {
            border: none;
            background: #2563eb;
            color: white;
            padding: 11px 22px;
            border-radius: 7px;
            font-weight: bold;
            cursor: pointer;
        }

        .search-button:hover {
            background: #1d4ed8;
        }

        .clear-button {
            background: #f3f4f6;
            color: #374151;
            padding: 11px 20px;
            border-radius: 7px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .clear-button:hover {
            background: #e5e7eb;
        }

        /* ================= RESULTS ================= */

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .results-title {
            font-size: 22px;
            margin: 0;
        }

        .results-count {
            color: #6b7280;
            font-size: 14px;
        }

        /* ================= CARD GRID ================= */

        .advertisement-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .advertisement-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .advertisement-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.10);
        }

        /* ================= IMAGE ================= */

        .image-container {
            width: 100%;
            height: 220px;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .advertisement-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .no-image {
            color: #9ca3af;
            font-size: 14px;
        }

        /* ================= CARD CONTENT ================= */

        .card-content {
            padding: 18px;
        }

        .category-badge {
            display: inline-block;
            background: #eff6ff;
            color: #1d4ed8;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-title {
            margin: 0 0 8px;
            font-size: 19px;
            color: #111827;
        }

        .description {
            color: #6b7280;
            font-size: 13px;
            line-height: 1.5;
            min-height: 40px;
            margin-bottom: 12px;
        }

        .price {
            font-size: 21px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 8px;
        }

        .location {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .view-button {
            display: block;
            width: 100%;
            text-align: center;
            background: #111827;
            color: white;
            padding: 11px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .view-button:hover {
            background: #374151;
        }

        /* ================= EMPTY ================= */

        .empty {
            background: white;
            border-radius: 12px;
            padding: 60px 20px;
            text-align: center;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
        }

        .empty h2 {
            margin-bottom: 10px;
            color: #374151;
        }

        .empty p {
            color: #6b7280;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 900px) {

            .advertisement-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .search-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {

            .header {
                padding: 15px 20px;
            }

            .header-inner {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .header-links {
                width: 100%;
                justify-content: space-between;
            }

            .advertisement-grid {
                grid-template-columns: 1fr;
            }

            .price-row {
                grid-template-columns: 1fr;
            }

            .search-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .search-button,
            .clear-button {
                text-align: center;
                width: 100%;
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

    <!-- ================= HEADER ================= -->

    <header class="header">

        <div class="header-inner">

            <a
                href="{{ route('advertisements.index') }}"
                class="logo"
            >
                Advertisement Platform
            </a>

            <div class="header-links">

                @auth

                    @if (auth()->user()->role === 'visitor')

                        <a
                            href="{{ route('visitor.dashboard') }}"
                            class="header-link"
                        >
                            Dashboard
                        </a>

                    @elseif (auth()->user()->role === 'advertiser')

                        <a
                            href="{{ route('advertiser.dashboard') }}"
                            class="header-link"
                        >
                            Dashboard
                        </a>

                    @elseif (auth()->user()->role === 'admin')

                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="header-link"
                        >
                            Dashboard
                        </a>

                    @endif

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                        style="display: inline;"
                    >
                        @csrf

                        <button
                            type="submit"
                            style="
                                border: none;
                                background: #ef4444;
                                color: white;
                                padding: 9px 16px;
                                border-radius: 6px;
                                cursor: pointer;
                                font-weight: bold;
                            "
                        >
                            Log Out
                        </button>
                    </form>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="login-button"
                    >
                        Login
                    </a>

                @endauth

            </div>

        </div>

    </header>


    <!-- ================= MAIN ================= -->

    <main class="container">

        <h1 class="page-title">
            Find What You Need
        </h1>

        <p class="page-subtitle">
            Browse approved advertisements from our marketplace.
        </p>


        <!-- ================= SEARCH / FILTER ================= -->

        <div class="search-box">

            <form
                method="GET"
                action="{{ route('advertisements.index') }}"
            >

                <div class="search-row">

                    <div class="field">

                        <label for="search">
                            Search
                        </label>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            placeholder="Search advertisements..."
                            value="{{ request('search') }}"
                        >

                    </div>


                    <div class="field">

                        <label for="category">
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


                    <div class="field">

                        <label for="location">
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


                <!-- PRICE FILTERS -->

                <div class="price-row">

                    <div class="field">

                        <label for="min_price">
                            Minimum Price
                        </label>

                        <input
                            type="number"
                            name="min_price"
                            id="min_price"
                            placeholder="Minimum price"
                            min="0"
                            value="{{ request('min_price') }}"
                        >

                    </div>


                    <div class="field">

                        <label for="max_price">
                            Maximum Price
                        </label>

                        <input
                            type="number"
                            name="max_price"
                            id="max_price"
                            placeholder="Maximum price"
                            min="0"
                            value="{{ request('max_price') }}"
                        >

                    </div>

                </div>


                <!-- SEARCH BUTTONS -->

                <div class="search-actions">

                    <button
                        type="submit"
                        class="search-button"
                    >
                        🔎 Search
                    </button>

                    <a
                        href="{{ route('advertisements.index') }}"
                        class="clear-button"
                    >
                        Clear Filters
                    </a>

                </div>

            </form>

        </div>


        <!-- ================= RESULTS ================= -->

        <div class="results-header">

            <h2 class="results-title">
                Available Advertisements
            </h2>

            <span class="results-count">
                {{ $advertisements->count() }}
                advertisement(s) found
            </span>

        </div>


        @if ($advertisements->count() > 0)

            <div class="advertisement-grid">

                @foreach ($advertisements as $advertisement)

                    <article class="advertisement-card">

                        <!-- IMAGE -->

                        <div class="image-container">

                            @if ($advertisement->image)

                                <img
                                    src="{{ asset('storage/' . $advertisement->image) }}"
                                    alt="{{ $advertisement->title }}"
                                    class="advertisement-image"
                                >

                            @else

                                <span class="no-image">
                                    No Image Available
                                </span>

                            @endif

                        </div>


                        <!-- CONTENT -->

                        <div class="card-content">

                            @if ($advertisement->category)

                                <span class="category-badge">
                                    {{ $advertisement->category }}
                                </span>

                            @endif


                            <h2 class="card-title">
                                {{ $advertisement->title }}
                            </h2>


                            <p class="description">

                                {{ \Illuminate\Support\Str::limit(
                                    $advertisement->description,
                                    100
                                ) }}

                            </p>


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

                                    📍
                                    {{ $advertisement->location }}

                                </div>

                            @endif


                            <a
                                href="{{ route('advertisements.show', $advertisement) }}"
                                class="view-button"
                            >
                                View Details
                            </a>

                        </div>

                    </article>

                @endforeach

                        </div>

            <!-- ================= PAGINATION ================= -->

            <div style="
                margin-top: 35px;
                display: flex;
                justify-content: center;
            ">
                {{ $advertisements->links() }}
            </div>

        @else

            <!-- ================= NO RESULTS ================= -->
            <div class="empty">

                <h2>
                    No advertisements found
                </h2>

                <p>
                    No advertisements match your search or filters.
                </p>

                <br>

                <a
                    href="{{ route('advertisements.index') }}"
                    class="clear-button"
                >
                    Clear Filters
                </a>

            </div>

        @endif

    </main>

</body>

</html>