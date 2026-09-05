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

            box-shadow:
                0 4px 20px rgba(0, 0, 0, 0.07);
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

            margin-bottom: 25px;
        }

        .seller-title {
            margin-top: 0;

            font-size: 18px;
        }

        .seller-name {
            font-size: 16px;

            font-weight: bold;

            color: #111827;
        }

        /* BUTTON */

        .contact-button {
            display: block;

            width: 100%;

            text-align: center;

            background: #2563eb;

            color: white;

            padding: 14px;

            border-radius: 8px;

            text-decoration: none;

            font-size: 16px;

            font-weight: bold;
        }

        .contact-button:hover {
            background: #1d4ed8;
        }

        /* SUCCESS MESSAGE */

        .success {
            background: #dcfce7;

            color: #166534;

            border: 1px solid #bbf7d0;

            padding: 12px 15px;

            border-radius: 8px;

            margin-bottom: 20px;
        }

        /* FOOTER NAVIGATION */

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


            <!-- SELLER -->

            <div class="seller-box">

                <h3 class="seller-title">

                    Seller Information

                </h3>

                <div class="seller-name">

                    {{ $advertisement->user->name }}

                </div>

            </div>


            <!-- CONTACT -->

            @auth

                @if (auth()->id() !== $advertisement->user_id)

                    <a
                        href="{{ route('contact.seller', $advertisement) }}"
                        class="contact-button"
                    >
                        💬 Contact Seller
                    </a>

                @else

                    <a
                        href="{{ route('advertiser.dashboard') }}"
                        class="contact-button"
                    >
                        Manage Advertisement
                    </a>

                @endif

            @else

                <a
                    href="{{ route('login') }}"
                    class="contact-button"
                >
                    Login to Contact Seller
                </a>

            @endauth


        </div>

    </div>


    <!-- NAVIGATION -->

    <div class="navigation">

        <a
            href="{{ route('advertisements.index') }}"
        >
            ← Back to Advertisements
        </a>

    </div>


</main>


</body>

</html>