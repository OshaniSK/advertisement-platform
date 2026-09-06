blade
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $advertisement->title }} - Advertisement</title>

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
            border-bottom: 1px solid #ddd;
            padding: 18px 40px;
        }

        .header-inner {
            max-width: 1100px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            text-decoration: none;
            color: #111827;
        }

        .back-link {
            text-decoration: none;
            color: #374151;
            font-size: 14px;
        }

        /* MAIN */

        .container {
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .advertisement {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.07);
        }

        /* IMAGE */

        .image-section {
            width: 100%;
            height: 450px;
            background: #f3f4f6;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main-image {
            width: 100%;
            height: 450px;
            object-fit: contain;
        }

        .no-image {
            color: #9ca3af;
            font-size: 16px;
        }

        /* CONTENT */

        .content {
            padding: 30px;
        }

        .category {
            display: inline-block;
            background: #eff6ff;
            color: #1d4ed8;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .title {
            margin: 0 0 15px;
            font-size: 32px;
            color: #111827;
        }

        .price {
            font-size: 28px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 20px;
        }

        /* DETAILS */

        .details {
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            padding: 20px 0;
            margin-bottom: 25px;
        }

        .detail {
            display: flex;
            margin-bottom: 12px;
        }

        .detail:last-child {
            margin-bottom: 0;
        }

        .detail-label {
            width: 130px;
            font-weight: bold;
            color: #374151;
        }

        .detail-value {
            color: #6b7280;
        }

        /* DESCRIPTION */

        .description-title {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .description {
            color: #4b5563;
            line-height: 1.7;
            white-space: pre-line;
            margin-bottom: 30px;
        }

        /* SELLER */

        .seller-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .seller-title {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .seller-name {
            font-size: 17px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 10px;
        }

        .seller-detail {
            color: #4b5563;
            margin-bottom: 8px;
            font-size: 14px;
        }

        /* ACTION BUTTONS */

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .button {
            flex: 1;
            display: block;
            text-align: center;
            padding: 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .contact-button {
            background: #2563eb;
            color: white;
        }

        .contact-button:hover {
            background: #1d4ed8;
        }

        .favorite-button {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
        }

        .favorite-button:hover {
            background: #ffe4e6;
        }

        .unfavorite-button {
            background: #be123c;
            color: white;
            border: 1px solid #be123c;
        }

        .unfavorite-button:hover {
            background: #9f1239;
        }

        /* SUCCESS */

        .success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* ERROR */

        .error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* NAVIGATION */

        .navigation {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navigation a {
            text-decoration: none;
            color: #374151;
            font-size: 14px;
        }

        /* MOBILE */

        @media (max-width: 700px) {

            .header {
                padding: 15px 20px;
            }

            .header-inner {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }

            .container {
                margin-top: 20px;
            }

            .image-section {
                height: 300px;
            }

            .main-image {
                height: 300px;
            }

            .content {
                padding: 20px;
            }

            .title {
                font-size: 25px;
            }

            .price {
                font-size: 24px;
            }

            .detail {
                flex-direction: column;
                gap: 4px;
            }

            .detail-label {
                width: auto;
            }

            .actions {
                flex-direction: column;
            }

            .navigation {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
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

        <a
            href="{{ route('advertisements.index') }}"
            class="back-link"
        >
            ← Back to Advertisements
        </a>

    </div>

</header>


<!-- MAIN -->

<main class="container">

    @if (session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    @if (session('error'))

        <div class="error">
            {{ session('error') }}
        </div>

    @endif


    <div class="advertisement">

        <!-- IMAGE -->

        <div class="image-section">

            @if ($advertisement->image)

                <img
                    src="{{ asset('storage/' . $advertisement->image) }}"
                    alt="{{ $advertisement->title }}"
                    class="main-image"
                >

            @else

                <span class="no-image">
                    No Image Available
                </span>

            @endif

        </div>


        <!-- CONTENT -->

        <div class="content">

            <!-- CATEGORY -->

            @if ($advertisement->category)

                <span class="category">
                    {{ $advertisement->category }}
                </span>

            @endif


            <!-- TITLE -->

            <h1 class="title">
                {{ $advertisement->title }}
            </h1>


            <!-- PRICE -->

            @if ($advertisement->price !== null)

                <div class="price">
                    Rs. {{ number_format($advertisement->price, 2) }}
                </div>

            @else

                <div class="price">
                    Price not specified
                </div>

            @endif


            <!-- DETAILS -->

            <div class="details">

                @if ($advertisement->category)

                    <div class="detail">

                        <div class="detail-label">
                            Category
                        </div>

                        <div class="detail-value">
                            {{ $advertisement->category }}
                        </div>

                    </div>

                @endif


                @if ($advertisement->location)

                    <div class="detail">

                        <div class="detail-label">
                            Location
                        </div>

                        <div class="detail-value">
                            📍 {{ $advertisement->location }}
                        </div>

                    </div>

                @endif


                <div class="detail">

                    <div class="detail-label">
                        Posted
                    </div>

                    <div class="detail-value">
                        {{ $advertisement->created_at->format('d M Y') }}
                    </div>

                </div>

            </div>


            <!-- DESCRIPTION -->

            <h2 class="description-title">
                Description
            </h2>

            <div class="description">
                {{ $advertisement->description }}
            </div>


            <!-- SELLER INFORMATION -->

            <div class="seller-box">

                <h3 class="seller-title">
                    Seller Information
                </h3>


                <div class="seller-name">
                    👤 {{ $advertisement->user->name }}
                </div>


                @if ($advertisement->user->phone)

                    <div class="seller-detail">
                        📞 {{ $advertisement->user->phone }}
                    </div>

                @else

                    <div class="seller-detail">
                        📞 Phone number not provided
                    </div>

                @endif


                @if ($advertisement->user->location)

                    <div class="seller-detail">
                        📍 {{ $advertisement->user->location }}
                    </div>

                @endif

            </div>


            <!-- ACTIONS -->

            <div class="actions">

                @auth

                    @if (auth()->id() !== $advertisement->user_id)

                        <!-- CONTACT SELLER -->

                        <a
                            href="{{ route('contact.seller', $advertisement) }}"
                            class="button contact-button"
                        >
                            💬 Contact Seller
                        </a>


                        <!-- FAVORITE -->

                        @php
                            $isFavorited = $advertisement
                                ->favorites()
                                ->where('user_id', auth()->id())
                                ->exists();
                        @endphp


                        @if ($isFavorited)

                            <form
                                action="{{ route('favorites.destroy', $advertisement) }}"
                                method="POST"
                                style="flex: 1;"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="button unfavorite-button"
                                    style="width: 100%;"
                                >
                                    ❤️ Remove Favorite
                                </button>

                            </form>

                        @else

                            <form
                                action="{{ route('favorites.store', $advertisement) }}"
                                method="POST"
                                style="flex: 1;"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="button favorite-button"
                                    style="width: 100%;"
                                >
                                    🤍 Add to Favorites
                                </button>

                            </form>

                        @endif

                    @else

                        <!-- OWNER -->

                        <a
                            href="{{ route('advertiser.dashboard') }}"
                            class="button contact-button"
                        >
                            ⚙️ Manage Advertisement
                        </a>

                    @endif

                @else

                    <!-- GUEST -->

                    <a
                        href="{{ route('login') }}"
                        class="button contact-button"
                    >
                        🔐 Login to Contact Seller
                    </a>

                    <a
                        href="{{ route('login') }}"
                        class="button favorite-button"
                    >
                        ❤️ Login to Favorite
                    </a>

                @endauth

            </div>

        </div>

    </div>


    <!-- NAVIGATION -->

    <div class="navigation">

        <a href="{{ route('advertisements.index') }}">
            ← Back to Advertisements
        </a>

    </div>

</main>

</body>

</html>

