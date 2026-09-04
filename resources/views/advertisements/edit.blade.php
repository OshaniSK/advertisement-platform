<!DOCTYPE html>
<html>
<head>
    <title>Edit Advertisement</title>
</head>

<body>

    <h1>Edit Advertisement</h1>

    <form method="POST" action="{{ route('advertisements.update', $advertisement) }}">

        @csrf
        @method('PUT')

        <div>
            <label>Title:</label>
            <input
                type="text"
                name="title"
                value="{{ old('title', $advertisement->title) }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Description:</label>
            <textarea
                name="description"
                required
            >{{ old('description', $advertisement->description) }}</textarea>
        </div>

        <br>

        <div>
            <label>Price:</label>
            <input
                type="number"
                name="price"
                value="{{ old('price', $advertisement->price) }}"
                min="0"
                step="0.01"
            >
        </div>

        <br>

        <div>
            <label>Category:</label>
            <input
                type="text"
                name="category"
                value="{{ old('category', $advertisement->category) }}"
            >
        </div>

        <br>

        <div>
            <label>Location:</label>
            <input
                type="text"
                name="location"
                value="{{ old('location', $advertisement->location) }}"
            >
        </div>

        <br>

        <button type="submit">
            Update Advertisement
        </button>

    </form>

    <br>

    <a href="{{ route('advertiser.dashboard') }}">
        Back to Dashboard
    </a>

</body>
</html>