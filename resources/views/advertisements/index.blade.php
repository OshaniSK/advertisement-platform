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
            color: #333;
        }

        /* Header */
        .header {
            background: #ffffff;
            padding: 20px 40px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 26px;
            font-weight: bold;
            color: #2563eb;
        }

        .header a {
            text-decoration: none;
            color: #333;
            margin-left: 20px;
        }

        /* Main container */
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
            font-size: 32px;
        }

        .page-title p {
            color: #777;
            margin-top: 8px;
        }

        /* Search box */
        .filter-box {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            margin-bottom: 30px;
        }

        .filter-box h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 15px;
        }

        .price-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 15px;
        }

        .filter-box input,
        .filter-box select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 14px;
        }

        .filter-actions {
            margin-top: 20px;
        }

        .search-btn {
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 15px;
        }

        .search-btn:hover {
            background: #1d4ed8;
        }

        .clear-btn {
            display: inline-block;
            margin-left: 10px;
            padding: 12px 20px;
            background: #eee;
            color: #333;
            text-decoration: none;
            border-radius: 7px;
        }

        .clear-btn:hover {
            background: #ddd;
        }

        /* Results */
        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .results-header h2 {
            margin: 0;
        }

        .result-count {
            color: #777;
        }

        /* Advertisement cards */
        .advertisement-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .advertisement-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .advertisement-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        /* Image */
        .advertisement-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }

        .no-image {
            width: 100%;
            height: 220px;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777;
            font-size: 16px;
        }

        /* Card content */
        .card-content {
            padding: 20px;
        }

        .card-title {
            font-size: 20px;
            margin: 0 0 10px 0;
            color: #222;
        }

        .price {
            font-size: 22px;
            font-weight: bold;
            color: #16a34a;
            margin-bottom: 12px;
        }

        .category {
            display: inline-block;
            background: #dbeafe;
            color: #1d4ed8;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .location {
            color: #666;
            margin: 8px 0;
        }

        .description {
            color: #666;
            line-height: 1.5;
            margin: 10px 0 15px 0;
        }

        .view-btn {
            display: block;
            text-align: center;
            background: #2563eb;
            color: white;
            padding: 11px;
            border-radius: 7px;
            text-decoration: none;
            margin-top: 15px;
        }

        .view-btn:hover {
            background: #1d4ed8;
        }

        /* No results */
        .no-results {
            background: white;
            padding: 50px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        }

        .no-results h2 {
            margin-bottom: 10px;
        }

        .no-results p {
            color: #777;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .advertisement-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .header {
                padding: 15px 20px;
            }

            .container {
                padding: 0 15px;
            }

            .advertisement-grid {
                grid-template-columns: 1fr;
            }

            .price-grid {
                grid-template-columns: 1fr;
            }

            .results-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
        }
    </style>

</head>

<body>

    <!-- Header -->

    <div class="header">

        <div class="logo">
            Advertisement Platform
        </div>

        <div>
            <a href="{{ route('advertisements.index') }}">
                Home
            </a>

            @auth

                @if(auth()->user()->role === 'advertiser')
                    <a href="{{ route('advertiser.dashboard') }}">
                        Dashboard
                    </a>
                @elseif(auth()->user()->role === 'visitor')
                    <a href="{{ route('visitor.dashboard') }}">
                        Dashboard
                    </a>
                @elseif(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}">
                        Dashboard
                    </a>
                @endif

            @else

                <a href="{{ route('login') }}">
                    Login
                </a>

            @endauth
        </div>

    </div>


    <!-- Main -->

    <div class="container">

        <!-- Page title -->

        <div class="page-title">

            <h1>
                Available Advertisements
            </h1>

            <p>
                Find products, services, vehicles, property and more.
            </p>

        </div>


        <!-- Filters -->

        <div class="filter-box">

            <h2>
                Search & Filter
            </h2>

            <form
                method="GET"
                action="{{ route('advertisements.index') }}"
            >

                <div class="filter-grid">

                    <!-- Search -->

                    <div>

                        <input
                            type="text"
                            name="search"
                            placeholder="Search advertisements..."
                            value="{{ request('search') }}"
                        >

                    </div>


                    <!-- Category -->

                    <div>

                        <select name="category">

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


                    <!-- Location -->

                    <div>

                        <select name="location">

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


                <!-- Price filters -->

                <div class="price-grid">

                    <div>

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


                    <div>

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


                <!-- Buttons -->

                <div class="filter-actions">

                    <button
                        type="submit"
                        class="search-btn"
                    >
                        Search
                    </button>

                    <a
                        href="{{ route('advertisements.index') }}"
                        class="clear-btn"
                    >
                        Clear Filters
                    </a>

                </div>

            </form>

        </div>


        <!-- Results header -->

        <div class="results-header">

            <h2>
                Latest Advertisements
            </h2>

            <div class="result-count">

                {{ $advertisements->count() }}

                advertisement(s) found

            </div>

        </div>


        <!-- Advertisement cards -->

        @if ($advertisements->count() > 0)

            <div class="advertisement-grid">

                @foreach ($advertisements as $advertisement)

                    <div class="advertisement-card">


                        <!-- Advertisement image -->

                        @if ($advertisement->image)

                            <img
                                src="{{ asset('storage/' . $advertisement->image) }}"
                                alt="{{ $advertisement->title }}"
                                class="advertisement-image"
                            >

                        @else

                            <div class="no-image">

                                No Image Available

                            </div>

                        @endif


                        <!-- Card content -->

                        <div class="card-content">


                            <!-- Category -->

                            @if ($advertisement->category)

                                <span class="category">

                                    {{ $advertisement->category }}

                                </span>

                            @endif


                            <!-- Title -->

                            <h2 class="card-title">

                                {{ $advertisement->title }}

                            </h2>


                            <!-- Price -->

                            <div class="price">

                                @if ($advertisement->price !== null)

                                    Rs. {{ number_format($advertisement->price, 2) }}

                                @else

                                    Price not specified

                                @endif

                            </div>


                            <!-- Location -->

                            @if ($advertisement->location)

                                <div class="location">

                                    📍 {{ $advertisement->location }}

                                </div>

                            @endif


                            <!-- Description -->

                            <div class="description">

                                {{ \Illuminate\Support\Str::limit($advertisement->description, 100) }}

                            </div>


                            <!-- View button -->

                            <a
                                href="{{ route('advertisements.show', $advertisement) }}"
                                class="view-btn"
                            >
                                View Details
                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <!-- No results -->

            <div class="no-results">

                <h2>
                    No Advertisements Found
                </h2>

                <p>
                    We couldn't find any advertisements matching your search criteria.
                </p>

                <a
                    href="{{ route('advertisements.index') }}"
                    class="clear-btn"
                >
                    View All Advertisements
                </a>

            </div>

        @endif

    </div>

</body>

</html>