<!DOCTYPE html>
<html>

<head>
    <title>{{ $advertisement->title }}</title>
</head>

<body>

@if (session('success'))
    <div style="padding: 10px; margin-bottom: 20px; background-color: #d4edda; color: #155724;">
        {{ session('success') }}
    </div>
@endif

    <h1>{{ $advertisement->title }}</h1>

    <p>
        <strong>Category:</strong>
        {{ $advertisement->category }}
    </p>

    <p>
        <strong>Description:</strong>
        {{ $advertisement->description }}
    </p>

    <p>
        <strong>Price:</strong>
        Rs. {{ $advertisement->price }}
    </p>

    <p>
        <strong>Location:</strong>
        {{ $advertisement->location }}
    </p>

    <p>
        <strong>Status:</strong>
        {{ ucfirst($advertisement->status) }}
    </p>

    <p>
        <strong>Advertiser:</strong>
        {{ $advertisement->user->name }}
    </p>

    <a href="{{ route('contact.seller', $advertisement) }}">
    Contact Seller
    </a>

    <br></br>

    <a href="{{ route('advertisements.index') }}">
        Back to Advertisements
    </a>

</body>

</html>