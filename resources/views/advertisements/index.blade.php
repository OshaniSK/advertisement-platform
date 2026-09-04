<!DOCTYPE html>
<html>

<head>
    <title>Advertisements</title>
</head>

<body>

    <h1>Available Advertisements</h1>

    <form method="GET" action="{{ route('advertisements.index') }}">

    <input
        type="text"
        name="search"
        placeholder="Search advertisements..."
        value="{{ request('search') }}"
    >

    <select name="category">
        <option value="">All Categories</option>

        @foreach ($categories as $category)
            <option value="{{ $category }}"
                {{ request('category') == $category ? 'selected' : '' }}>
                {{ $category }}
            </option>
        @endforeach

    </select>

    <select name="location">
        <option value="">All Locations</option>

        @foreach ($locations as $location)
            <option value="{{ $location }}"
                {{ request('location') == $location ? 'selected' : '' }}>
                {{ $location }}
            </option>
        @endforeach

    </select>

    <button type="submit">
        Search
    </button>

</form>

<hr>

    @if ($advertisements->count() > 0)

        @foreach ($advertisements as $advertisement)

            <div>

                <h2>{{ $advertisement->title }}</h2>

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

                <a href="{{ route('advertisements.show', $advertisement) }}">
    View Details
</a>

                <hr>

            </div>

        @endforeach

    @else

        <p>No approved advertisements available.</p>

    @endif

</body>

</html>