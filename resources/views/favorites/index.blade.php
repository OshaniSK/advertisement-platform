<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>My Favorites</title>

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

        .header {
            background: white;
            border-bottom: 1px solid #e5e7eb;
        }

        .header-inner {
            max-width: 1200px;
            margin: auto;
            padding: 16px 25px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            text-decoration: none;
            color: #111827;
            font-size: 21px;
            font-weight: 800;
        }

        .logo span {
            color: #2563eb;
        }

        .header-link {
            text-decoration: none;
            color: #374151;
            font-size: 14px;
            font-weight: 600;
            margin-left: 15px;
        }

        .header-link:hover {
            color: #2563eb;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 35px 25px 60px;
        }

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            margin: 0 0 8px;
            font-size: 30px;
        }

        .page-header p {
            margin: 0;
            color: #6b7280;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .favorite-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .card {
            background: white;
            border-radius: 14px;
            overflow: hidden;

            box-shadow:
                0 3px 15px rgba(0, 0, 0, 0.06);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-4px);

            box-shadow:
                0 10px 25px rgba(0, 0, 0, 0.10);
        }

        .image {
            width: 100%;
            height: 220px;
            background: #f3f4f6;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;
        }

        .image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-image {
            color: #9ca3af;
        }

        .content {
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

        .title {
            margin: 0 0 10px;

            font-size: 18px;
            font-weight: 700;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .price {
            font-size: 20px;
            font-weight: 800;

            margin-bottom: 9px;
        }

        .location {
            color: #6b7280;
            font-size: 13px;

            margin-bottom: 15px;
        }

        .buttons {
            display: grid;

            grid-template-columns: 1fr auto;

            gap: 8px;
        }

        .view-button {
            display: flex;
            align-items: center;
            justify-content: center;

            background: #2563eb;
            color: white;

            text-decoration: none;

            padding: 11px;

            border-radius: 8px;

            font-size: 14px;
            font-weight: 700;
        }

        .view-button:hover {
            background: #1d4ed8;
        }

        .remove-button {
            border: none;

            background: #fee2e2;
            color: #dc2626;

            padding: 0 15px;

            border-radius: 8px;

            cursor: pointer;

            font-size: 18px;
        }

        .remove-button:hover {
            background: #fecaca;
        }

        .empty {
            background: white;

            border-radius: 14px;

            padding: 70px 20px;

            text-align: center;

            box-shadow:
                0 3px 15px rgba(0, 0, 0, 0.05);
        }

        .empty-icon {
            font-size: 50px;
            margin-bottom: 15px;
        }

        .empty h2 {
            margin: 0 0 10px;
        }

        .empty p {
            color: #6b7280;
            margin-bottom: 22px;
        }

        .browse-button {
            display: inline-block;

            background: #2563eb;
            color: white;

            text-decoration: none;

            padding: 12px 20px;

            border-radius: 8px;

            font-size: 14px;
            font-weight: 700;
        }

        .browse-button:hover {
            background: #1d4ed8;
        }

        .pagination {
            margin-top: 35px;

            display: flex;
            justify-content: center;
        }

        @media (max-width: 900px) {

            .favorite-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 600px) {

            .header-inner {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .header-link {
                margin-left: 0;
                margin-right: 15px;
            }

            .container {
                padding: 25px 15px 50px;
            }

            .favorite-grid {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>

<body>


<header class="header">

    <div class="header-inner">

        <a
            href="{{ route('advertisements.index') }}"
            class="logo"
        >
            Advertisement <span>Platform</span>
        </a>

        <div>

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

            <a
                href="{{ route('advertisements.index') }}"
                class="header-link"
            >
                Browse
            </a>

        </div>

    </div>

</header>


<main class="container">


    <div class="page-header">

        <h1>
            ❤️ My Favorites
        </h1>

        <p>
            Advertisements you've saved for later.
        </p>

    </div>


    @if (session('success'))

        <div class="success">

            {{ session('success') }}

        </div>

    @endif


    @if ($favorites->count() > 0)

        <div class="favorite-grid">

            @foreach ($favorites as $favorite)

                @php
                    $advertisement = $favorite->advertisement;
                @endphp

                @if ($advertisement)

                    <article class="card">


                        <div class="image">

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


                        <div class="content">


                            @if ($advertisement->category)

                                <span class="category">

                                    {{ $advertisement->category }}

                                </span>

                            @endif


                            <h2 class="title">

                                {{ $advertisement->title }}

                            </h2>


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


                            <div class="buttons">

                                <a
                                    href="{{ route('advertisements.show', $advertisement) }}"
                                    class="view-button"
                                >
                                    View Details →
                                </a>


                                <form
                                    action="{{ route('favorites.destroy', $advertisement) }}"
                                    method="POST"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="remove-button"
                                        title="Remove from favorites"
                                    >
                                        ❤️
                                    </button>

                                </form>

                            </div>


                        </div>


                    </article>

                @endif

            @endforeach

        </div>


        <div class="pagination">

            {{ $favorites->links() }}

        </div>


    @else

        <div class="empty">

            <div class="empty-icon">
                ❤️
            </div>

            <h2>
                No Favorites Yet
            </h2>

            <p>
                You haven't saved any advertisements yet.
            </p>

            <a
                href="{{ route('advertisements.index') }}"
                class="browse-button"
            >
                Browse Advertisements
            </a>

        </div>

    @endif


</main>

</body>

</html>