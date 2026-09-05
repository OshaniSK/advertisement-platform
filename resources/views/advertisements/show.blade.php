<!DOCTYPE html>
<html>

<head>
    <title>{{ $advertisement->title }}</title>
</head>

<body>

    {{-- Success Message --}}
    @if (session('success'))
        <div style="padding: 10px; margin-bottom: 20px; background-color: #d4edda; color: #155724;">
            {{ session('success') }}
        </div>
    @endif


    {{-- Advertisement Image --}}
    @if ($advertisement->image)
        <div style="margin-bottom: 20px;">
            <img
                src="{{ asset('storage/' . $advertisement->image) }}"
                alt="{{ $advertisement->title }}"
                width="500"
            >
        </div>
    @endif


    {{-- Advertisement Title --}}
    <h1>{{ $advertisement->title }}</h1>


    {{-- Category --}}
    <p>
        <strong>Category:</strong>
        {{ $advertisement->category }}
    </p>


    {{-- Description --}}
    <p>
        <strong>Description:</strong>
        {{ $advertisement->description }}
    </p>


    {{-- Price --}}
    <p>
        <strong>Price:</strong>
        Rs. {{ $advertisement->price }}
    </p>


    {{-- Location --}}
    <p>
        <strong>Location:</strong>
        {{ $advertisement->location }}
    </p>


    {{-- Status --}}
    <p>
        <strong>Status:</strong>
        {{ ucfirst($advertisement->status) }}
    </p>


    {{-- Advertiser --}}
    <p>
        <strong>Advertiser:</strong>
        {{ $advertisement->user->name }}
    </p>


    <br>


    {{-- Contact Seller --}}
    <a href="{{ route('contact.seller', $advertisement) }}">
        Contact Seller
    </a>


    <br><br>


    {{-- Back to Advertisements --}}
    <a href="{{ route('advertisements.index') }}">
        Back to Advertisements
    </a>

</body>

</html>