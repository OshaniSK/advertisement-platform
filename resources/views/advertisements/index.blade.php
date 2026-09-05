<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Advertisements</title>

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

        /* HEADER */

        .header {
            background: white;
            border-bottom: 1px solid #e5e7eb;
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
            font-size: 22px;
            font-weight: bold;
            color: #111827;
            text-decoration: none;
        }

        .header-link {
            color: #374151;
            text-decoration: none;
            margin-left: 20px;
            font-size: 14px;
        }

        /* MAIN */

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h1 {
            margin: 0;
            font-size: 30px;
            color: #111827;
        }

        .page-title p {
            color: #6b7280;
            margin-top: 8px;
        }

        /* SEARCH BOX */

        .filter-box {
            background: white;
            padding: 22px;

            border-radius: 12px;

            box-shadow:
                0 3px 15px rgba(0, 0, 0, 0.05);

            margin-bottom: 30px;
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

        input,
        select {
            width: 100%;

            padding: 12px;

            border: 1px solid #d1d5db;

            border-radius: 7px;

            font-size: 14px;

            background: white;
        }

        input:focus,
        select:focus {
            outline: none;

            border-color: #2563eb;
        }

        .filter-label {
            display: block;

            font-size: 13px;

            font-weight: bold;

            color: #374151;

            margin-bottom: 6px;
        }

        .button {
            display: inline-block;

            padding: 12px 20px;

            border-radius: 7px;

            border: none;

            cursor: pointer;

            text-decoration: none;

            font-size: 14px;

            font-weight: bold;
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

        /* RESULTS HEADER */

        .results-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 18px;
        }

        .results-header h2 {
            margin: 0;

            font-size: 20px;
        }

        .result-count {
            color: #6b7280;

            font-size: 14px;
        }

        /* ADVERTISEMENT GRID */

        .advertisement-grid {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 22px;
        }

        /* CARD */

        .card {
            background: white;

            border-radius: 12px;

            overflow: hidden;

            box-shadow:
                0 3px 15px rgba(0, 0, 0, 0.06);

            transition:
                transform 0.2s,
                box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-4px);

            box-shadow:
                0 8px 25px rgba(0, 0, 0, 0.10);
        }

        /* IMAGE */

        .card-image {
            width: 100%;

            height: 220px;

            background: #f3f4f6;

            display: flex;

            align-items: center;

            justify-content: center;

            overflow: hidden;
        }

        .card-image img {
            width: 100%;

            height: 100%;

            object-fit: cover;
        }

        .no-image {
            color: #9ca3af;

            font-size: 14px;
        }

        /* CARD CONTENT */

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

            font-weight: bold;

            margin-bottom: 10px;
        }

        .card-title {
            font-size: 19px;

            font-weight: bold;

            color: #111827;

            margin: 0 0 10px;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }

        .price {
            font-size: 21px;

            font-weight: bold;

            color: #111827;

            margin-bottom: 10px;
        }

        .location {
            color: #6b7280;

            font-size: 14px;

            margin-bottom: 12px;
        }

        .description {
            color: #6b7280;

            font-size: 14px;

            line-height: 1.5;

            height: 42px;

            overflow: hidden;

            margin-bottom: 15px;
        }

        .view-button {
            display: block;

            width: 100%;

            text-align: center;

            background: #2563eb;

            color: white;

            padding: 11px;

            border-radius: 7px;

            text-decoration: none;

            font-size: 14px;

            font-weight: bold;
        }

        .view-button:hover {
            background: #1d4ed8;
        }

        /* EMPTY */

        .empty {
            background: white;

            padding: 50px 20px;

            text-align: center;

            border-radius: 12px;
        }

        .empty h3 {
            margin-bottom: 8px;
        }

        .empty p {
            color: #6b7280;
        }

        /* PAGINATION */

        .pagination {
            margin-top: 35px;

            display: flex;

            justify-content: center;
        }

        /* RESPONSIVE */

        @media (max-width: 900px) {

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

        @media (max-width: 600px) {

            .header {
                padding: 15px 20px;
            }

            .header-inner {
                flex-direction: column;

                gap: 12px;

                align-items: flex-start;
            }

            .header-link {
                margin-left: 0;

                margin-right: 15px;
            }

            .advertisement-grid {
                grid-template-columns:
                    1fr;
            }

            .search-row,
            .price-row {
                grid-template-columns:
                    1fr;
            }

            .page-title h1 {
                font-size: 25px;
            }

        }

    </style>

</head>


<body>


<!-- HEADER -->

<header class="header">

    <div class="header-inner">

        <a
            href="{{ route('advertisements.index') }}"
            class="logo"
        >
            Advertisement Platform
        </a>

        <div>

            @auth

                @if (auth()->user()->role === 'advertiser')

                    <a
                        href="{{ route('advertiser.dashboard') }}"
                        class="header-link"
                    >
                        My Dashboard
                    </a>

                @elseif (auth()->user()->role === 'visitor')

                    <a
                        href="{{ route('visitor.dashboard') }}"
                        class="header-link"
                    >
                        My Dashboard
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
                    class="header-link"
                >
                    Register
                </a>

            @endauth

        </div>

    </div>

</header>


<!-- MAIN -->

<main class="container">


    <!-- TITLE -->

    <div class="page-title">

        <h1>
            Find What You Need
        </h1>

        <p>
            Browse advertisements from sellers.
        </p>

    </div>


    <!-- FILTERS -->

    <div class="filter-box">

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
                        placeholder="Search advertisements..."
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
                    Search
                </button>


                <a
                    href="{{ route('advertisements.index') }}"
                    class="button clear-button"
                >
                    Clear
                </a>


            </div>


        </form>

    </div>


    <!-- RESULTS HEADER -->

    <div class="results-header">

        <h2>
            Latest Advertisements
        </h2>

        <span class="result-count">

            {{ $advertisements->total() }}

            advertisement(s)

        </span>

    </div>


    <!-- ADVERTISEMENTS -->

    @if ($advertisements->count() > 0)


        <div class="advertisement-grid">


            @foreach ($advertisements as $advertisement)


                <article class="card">


                    <!-- IMAGE -->

                    <div class="card-image">

                        @if ($advertisement->image)

                            <img
                                src="{{ asset('storage/' . $advertisement->image) }}"
                                alt="{{ $advertisement->title }}"
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
                            View Details
                        </a>


                    </div>


                </article>


            @endforeach


        </div>


        <!-- PAGINATION -->

        <div class="pagination">

            {{ $advertisements->links() }}

        </div>


    @else


        <!-- NO RESULTS -->

        <div class="empty">

            <h3>
                No advertisements found
            </h3>

            <p>
                No advertisements match your search or filters.
            </p>

            <br>

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