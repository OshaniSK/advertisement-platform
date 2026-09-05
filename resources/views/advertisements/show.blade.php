<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $advertisement->title }} - Advertisement Platform</title>

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

        /* Header */
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
            color: #222;
            text-decoration: none;
        }

        .back-link {
            text-decoration: none;
            color: #555;
            font-size: 14px;
        }

        .back-link:hover {
            color: #000;
        }

        /* Main */
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Success message */
        .success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        /* Advertisement layout */
        .advertisement {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .top-section {
            display: grid;
            grid-template-columns: 55% 45%;
            min-height: 500px;
        }

        /* Image */
        .image-section {
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 500px;
        }

        .advertisement-image {
            width: 100%;
            height: 500px;
            object-fit: contain;
            background: #f0f0f0;
        }

        .no-image {
            color: #888;
            font-size: 18px;
        }

        /* Details */
        .details-section {
            padding: 40px;
        }

        .category {
            display: inline-block;
            background: #eef2ff;
            color: #4338ca;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 18px;
        }

        .title {
            font-size: 34px;
            line-height: 1.2;
            margin: 0 0 20px;
            color: #111827;
        }

        .price {
            font-size: 32px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 25px;
        }

        .location {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #555;
            font-size: 15px;
            margin-bottom: 30px;
        }

        .contact-button {
            display: block;
            width: 100%;
            text-align: center;
            background: #111827;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 12px;
            transition: 0.2s;
        }

        .contact-button:hover {
            background: #374151;
        }

        .login-button {
            display: block;
            width: 100%;
            text-align: center;
            background: #2563eb;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 12px;
        }

        .login-button:hover {
            background: #1d4ed8;
        }

        /* Description */
        .description-section {
            border-top: 1px solid #eee;
            padding: 35px 40px;
        }

        .section-title {
            font-size: 21px;
            margin: 0 0 15px;
            color: #111827;
        }

        .description {
            color: #555;
            line-height: 1.7;
            font-size: 15px;
            white-space: pre-line;
        }

        /* Seller */
        .seller-section {
            border-top: 1px solid #eee;
            padding: 35px 40px;
        }

        .seller-card {
            display: flex;
            align-items: center;
            gap: 18px;
            background: #f9fafb;
            padding: 20px;
            border-radius: 10px;
        }

        .seller-avatar {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: #e5e7eb;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
            font-weight: bold;
            color: #555;
        }

        .seller-name {
            font-size: 17px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .seller-label {
            color: #777;
            font-size: 13px;
        }

        /* Bottom */
        .bottom-section {
            border-top: 1px solid #eee;
            padding: 25px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .back-button {
            text-decoration: none;
            color: #374151;
            font-weight: bold;
        }

        .back-button:hover {
            color: #000;
        }

        .status {
            font-size: 13px;
            color: #777;
        }

        /* Responsive */
        @media (max-width: 800px) {

            .header {
                padding: 15px 20px;
            }

            .top-section {
                grid-template-columns: 1fr;
            }

            .image-section {
                min-height: 350px;
            }

            .advertisement-image {
                height: 350px;
            }

            .details-section {
                padding: 25px;
            }

            .description-section,
            .seller-section {
                padding: 25px;
            }

            .bottom-section {
                padding: 20px 25px;
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .title {
                font-size: 27px;
            }

            .price {
                font-size: 27px;
            }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header class="header">
        <div class="header-inner">

            <a href="{{ route('advertisements.index') }}" class="logo">
                Advertisement Platform
            </a>

            <a href="{{ route('advertisements.index') }}" class="back-link">
                ← Browse Advertisements
            </a>

        </div>
    </header>


    <main class="container">

        <!-- Success Message -->
        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif


        <div class="advertisement">

            <!-- Image + Main Details -->
            <div class="top-section">

                <!-- Advertisement Image -->
                <div class="image-section">

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

                </div>


                <!-- Advertisement Details -->
                <div class="details-section">

                    @if ($advertisement->category)
                        <span class="category">
                            {{ $advertisement->category }}
                        </span>
                    @endif


                    <h1 class="title">
                        {{ $advertisement->title }}
                    </h1>


                    @if ($advertisement->price !== null)
                        <div class="price">
                            Rs. {{ number_format($advertisement->price, 2) }}
                        </div>
                    @else
                        <div class="price">
                            Price not specified
                        </div>
                    @endif


                    @if ($advertisement->location)
                        <div class="location">
                            <span>📍</span>
                            <span>{{ $advertisement->location }}</span>
                        </div>
                    @endif


                    @auth

                        @if (auth()->id() !== $advertisement->user_id)

                            <a
                                href="{{ route('contact.seller', $advertisement) }}"
                                class="contact-button"
                            >
                                Contact Seller
                            </a>

                        @else

                            <a
                                href="{{ route('advertisements.edit', $advertisement) }}"
                                class="contact-button"
                            >
                                Edit Advertisement
                            </a>

                        @endif

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="login-button"
                        >
                            Login to Contact Seller
                        </a>

                    @endauth

                </div>

            </div>


            <!-- Description -->
            <div class="description-section">

                <h2 class="section-title">
                    Description
                </h2>

                <div class="description">
                    {{ $advertisement->description }}
                </div>

            </div>


            <!-- Seller Information -->
            <div class="seller-section">

                <h2 class="section-title">
                    Seller Information
                </h2>

                <div class="seller-card">

                    <div class="seller-avatar">
                        {{ strtoupper(substr($advertisement->user->name, 0, 1)) }}
                    </div>

                    <div>
                        <div class="seller-name">
                            {{ $advertisement->user->name }}
                        </div>

                        <div class="seller-label">
                            Advertisement Seller
                        </div>
                    </div>

                </div>

            </div>


            <!-- Bottom -->
            <div class="bottom-section">

                <a
                    href="{{ route('advertisements.index') }}"
                    class="back-button"
                >
                    ← Back to Advertisements
                </a>

                <div class="status">
                    {{ ucfirst($advertisement->status) }}
                </div>

            </div>

        </div>

    </main>

</body>

</html>