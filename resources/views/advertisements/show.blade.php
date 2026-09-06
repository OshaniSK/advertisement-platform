php
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

        /* ================= HEADER ================= */

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

        .back-link:hover {
            color: #2563eb;
        }

        /* ================= MAIN ================= */

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

        /* ================= IMAGE GALLERY ================= */

        .gallery {
            width: 100%;
            background: #f3f4f6;
            padding: 20px;
        }

        .gallery-main {
            width: 100%;
            height: 450px;

            display: flex;
            justify-content: center;
            align-items: center;

            background: white;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .gallery-main-image {
            width: 100%;
            height: 450px;
            object-fit: contain;
            cursor: pointer;
            transition: opacity 0.2s ease-in-out;
        }

        .gallery-main-image:hover {
            opacity: 0.97;
        }

        .gallery-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.4);
            color: white;
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
            cursor: pointer;
            z-index: 10;
            transition: background 0.2s;
        }

        .gallery-nav-btn:hover {
            background: rgba(0, 0, 0, 0.75);
        }

        .gallery-prev {
            left: 15px;
        }

        .gallery-next {
            right: 15px;
        }

        .image-counter {
            position: absolute;
            bottom: 15px;
            right: 20px;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 14px;
            z-index: 10;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .no-image {
            color: #9ca3af;
            font-size: 16px;
        }

        /* ================= THUMBNAILS ================= */

        .gallery-thumbnails {
            display: flex;
            gap: 12px;

            margin-top: 15px;

            overflow-x: auto;

            padding-bottom: 5px;
        }

        .thumbnail {
            width: 85px;
            height: 70px;

            padding: 0;

            border: 2px solid transparent;
            border-radius: 8px;

            background: white;

            overflow: hidden;

            cursor: pointer;

            flex-shrink: 0;
        }

        .thumbnail:hover {
            border-color: #9ca3af;
        }

        .thumbnail.active {
            border-color: #2563eb;
        }

        .thumbnail img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            display: block;
        }

        /* ================= CONTENT ================= */

        .content {
            padding: 30px;
        }

        /* ================= CATEGORY ================= */

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

        /* ================= TITLE ================= */

        .title {
            margin: 0 0 15px;

            font-size: 32px;

            color: #111827;
        }

        /* ================= PRICE ================= */

        .price {
            font-size: 28px;
            font-weight: bold;

            color: #111827;

            margin-bottom: 20px;
        }

        /* ================= DETAILS ================= */

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

        /* ================= DESCRIPTION ================= */

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

        /* ================= SELLER ================= */

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

        /* ================= CONTACT BUTTON ================= */

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

        /* ================= SUCCESS MESSAGE ================= */

        .success {
            background: #dcfce7;

            color: #166534;

            border: 1px solid #bbf7d0;

            padding: 12px 15px;

            border-radius: 8px;

            margin-bottom: 20px;
        }

        /* ================= NAVIGATION ================= */

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

        .navigation a:hover {
            color: #2563eb;
        }

        /* ================= IMAGE LIGHTBOX ================= */

        .lightbox {
            display: none;

            position: fixed;

            z-index: 9999;

            left: 0;
            top: 0;

            width: 100%;
            height: 100%;

            background: rgba(0, 0, 0, 0.9);

            justify-content: center;
            align-items: center;

            padding: 30px;
        }

        .lightbox.show {
            display: flex;
        }

        .lightbox-image {
            max-width: 90%;
            max-height: 90%;

            object-fit: contain;

            border-radius: 8px;
        }

        .lightbox-close {
            position: absolute;

            top: 20px;
            right: 30px;

            color: white;

            font-size: 40px;

            font-weight: bold;

            cursor: pointer;

            line-height: 1;
        }

        .lightbox-close:hover {
            color: #d1d5db;
        }

        /* ================= MOBILE ================= */

        @media (max-width: 700px) {

            .header {
                padding: 15px 20px;
            }

            .header-inner {
                gap: 15px;
            }

            .logo {
                font-size: 18px;
            }

            .back-link {
                font-size: 13px;
            }

            .container {
                margin-top: 20px;
                padding: 0 10px;
            }

            /* Gallery */

            .gallery {
                padding: 10px;
            }

            .gallery-main {
                height: 300px;
            }

            .gallery-main-image {
                height: 300px;
            }

            .gallery-nav-btn {
                width: 36px;
                height: 36px;
                font-size: 18px;
            }

            .image-counter {
                padding: 4px 10px;
                font-size: 12px;
                bottom: 10px;
                right: 10px;
            }

            .thumbnail {
                width: 70px;
                height: 60px;
            }

            /* Content */

            .content {
                padding: 20px;
            }

            .title {
                font-size: 25px;
            }

            .price {
                font-size: 24px;
            }

            /* Details */

            .detail {
                flex-direction: column;
                gap: 4px;
            }

            .detail-label {
                width: auto;
            }

            /* Navigation */

            .navigation {
                flex-direction: column;

                gap: 15px;

                align-items: flex-start;
            }

            /* Lightbox */

            .lightbox {
                padding: 15px;
            }

            .lightbox-image {
                max-width: 95%;
                max-height: 85%;
            }

            .lightbox-close {
                top: 15px;
                right: 20px;
                font-size: 35px;
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

        <a
            href="{{ route('advertisements.index') }}"
            class="back-link"
        >
            ← Back to Advertisements
        </a>

    </div>

</header>


<!-- ================= MAIN ================= -->

<main class="container">


    @if (session('success'))

        <div class="success">

            {{ session('success') }}

        </div>

    @endif


    <div class="advertisement">


        <!-- ================= IMAGE GALLERY ================= -->

        <div class="gallery">


            <!-- MAIN IMAGE -->

            @php
                $allImages = collect();
                if ($advertisement->image) {
                    $allImages->push($advertisement->image);
                }
                if ($advertisement->images) {
                    foreach($advertisement->images as $img) {
                        $allImages->push($img->image);
                    }
                }
                $totalImages = $allImages->count();
            @endphp

            <div class="gallery-main">

                @if ($totalImages > 0)

                    @if ($totalImages > 1)
                        <button type="button" class="gallery-nav-btn gallery-prev" onclick="prevImage(event)">&#10094;</button>
                        <button type="button" class="gallery-nav-btn gallery-next" onclick="nextImage(event)">&#10095;</button>
                        <div id="imageCounter" class="image-counter">Image 1 of {{ $totalImages }}</div>
                    @endif

                    <img
                        id="mainGalleryImage"
                        src="{{ asset('storage/' . $allImages->first()) }}"
                        alt="{{ $advertisement->title }}"
                        class="gallery-main-image"
                        onclick="openLightbox(this.src)"
                    >

                @else

                    <span class="no-image">
                        No Image Available
                    </span>

                @endif

            </div>


            <!-- ================= THUMBNAILS ================= -->

            @if ($totalImages > 0)

                <div class="gallery-thumbnails">

                    @foreach ($allImages as $index => $imagePath)

                        <button
                            type="button"
                            class="thumbnail {{ $index === 0 ? 'active' : '' }}"
                            onclick="changeMainImage(
                                '{{ asset('storage/' . $imagePath) }}',
                                this
                            )"
                        >

                            <img
                                src="{{ asset('storage/' . $imagePath) }}"
                                alt="{{ $advertisement->title }}"
                            >

                        </button>

                    @endforeach

                </div>

            @endif


        </div>


        <!-- ================= CONTENT ================= -->

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


            <!-- ================= DETAILS ================= -->

            <div class="details">


                <!-- CATEGORY -->

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


                <!-- LOCATION -->

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


                <!-- POSTED DATE -->

                <div class="detail">

                    <div class="detail-label">
                        Posted
                    </div>

                    <div class="detail-value">

                        {{ $advertisement->created_at->format('d M Y') }}

                    </div>

                </div>


            </div>


            <!-- ================= DESCRIPTION ================= -->

            <h2 class="description-title">

                Description

            </h2>


            <div class="description">

                {{ $advertisement->description }}

            </div>


            <!-- ================= SELLER ================= -->

            <div class="seller-box">

                <h3 class="seller-title">

                    Seller Information

                </h3>


                <div class="seller-name">

                    {{ $advertisement->user->name }}

                </div>

            </div>


            <!-- ================= CONTACT SELLER ================= -->

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


    <!-- ================= NAVIGATION ================= -->

    <div class="navigation">

        <a
            href="{{ route('advertisements.index') }}"
        >
            ← Back to Advertisements
        </a>

    </div>


</main>


<!-- ================= IMAGE LIGHTBOX ================= -->

<div
    id="imageLightbox"
    class="lightbox"
    onclick="closeLightbox(event)"
>

    <span
        class="lightbox-close"
        onclick="closeLightbox()"
    >
        &times;
    </span>


    <img
        id="lightboxImage"
        class="lightbox-image"
        src=""
        alt="Advertisement Image"
    >

</div>


<!-- ================= JAVASCRIPT ================= -->

<script>

    /*
    |--------------------------------------------------------------------------
    | Change Main Gallery Image
    |--------------------------------------------------------------------------
    */

    let currentImageIndex = 0;

    function changeMainImage(imageUrl, thumbnail) {
        const mainImage = document.getElementById('mainGalleryImage');
        const counter = document.getElementById('imageCounter');
        const thumbnails = document.querySelectorAll('.thumbnail');
        const total = thumbnails.length;

        // Find index of clicked thumbnail
        let index = 0;
        let isSameImage = false;
        thumbnails.forEach((item, i) => {
            if (item === thumbnail) {
                index = i;
                if (item.classList.contains('active')) {
                    isSameImage = true;
                }
            }
        });

        if (mainImage && !isSameImage) {
            // Smooth transition
            mainImage.style.opacity = 0;
            setTimeout(() => {
                mainImage.src = imageUrl;
                mainImage.style.opacity = 1;
            }, 200);
        }

        currentImageIndex = index;

        if (counter && total > 0) {
            counter.innerText = 'Image ' + (index + 1) + ' of ' + total;
        }

        thumbnails.forEach(function(item) {
            item.classList.remove('active');
        });

        if (thumbnail) {
            thumbnail.classList.add('active');
            // Smooth scroll thumbnail into view if needed (especially useful on mobile)
            thumbnail.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        }
    }

    function prevImage(event) {
        if (event) event.stopPropagation();
        const thumbnails = document.querySelectorAll('.thumbnail');
        const total = thumbnails.length;
        if (total <= 1) return;
        
        let newIndex = currentImageIndex - 1;
        if (newIndex < 0) {
            newIndex = total - 1;
        }
        if (thumbnails[newIndex]) {
            thumbnails[newIndex].click();
        }
    }

    function nextImage(event) {
        if (event) event.stopPropagation();
        const thumbnails = document.querySelectorAll('.thumbnail');
        const total = thumbnails.length;
        if (total <= 1) return;
        
        let newIndex = currentImageIndex + 1;
        if (newIndex >= total) {
            newIndex = 0;
        }
        if (thumbnails[newIndex]) {
            thumbnails[newIndex].click();
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Open Lightbox
    |--------------------------------------------------------------------------
    */

    function openLightbox(imageUrl) {

        const lightbox =
            document.getElementById('imageLightbox');

        const lightboxImage =
            document.getElementById('lightboxImage');


        if (!lightbox || !lightboxImage) {
            return;
        }


        lightboxImage.src = imageUrl;

        lightbox.classList.add('show');

        document.body.style.overflow = 'hidden';

    }


    /*
    |--------------------------------------------------------------------------
    | Close Lightbox
    |--------------------------------------------------------------------------
    */

    function closeLightbox(event) {

        /*
        Close only when:

        1. The close button is clicked
        2. The dark background is clicked
        */

        if (
            event &&
            event.target &&
            event.target.id !== 'imageLightbox' &&
            !event.target.classList.contains('lightbox-close')
        ) {

            return;

        }


        const lightbox =
            document.getElementById('imageLightbox');


        if (lightbox) {

            lightbox.classList.remove('show');

        }


        document.body.style.overflow = '';

    }


    /*
    |--------------------------------------------------------------------------
    | ESC Key
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            const lightbox =
                document.getElementById('imageLightbox');


            if (lightbox) {

                lightbox.classList.remove('show');

            }


            document.body.style.overflow = '';

        }

    });

</script>


</body>

</html>
