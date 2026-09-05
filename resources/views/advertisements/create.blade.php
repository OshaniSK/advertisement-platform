<!DOCTYPE html>
<html>
<head>
    <title>Create Advertisement</title>
</head>

<body>

    <h1>Create Advertisement</h1>

    @if ($errors->any())
        <div>
            <strong>Please fix the following errors:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('advertisements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="title">Advertisement Title</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="description">Description</label>
            <textarea
                id="description"
                name="description"
                rows="5"
                required
            >{{ old('description') }}</textarea>
        </div>

        <br>

        <div>
            <label for="price">Price</label>
            <input
                type="number"
                id="price"
                name="price"
                step="0.01"
                min="0"
                value="{{ old('price') }}"
            >
        </div>

        <br>

        <div>
            <label for="category">Category</label>
            <select id="category" name="category">
                <option value="">Select Category</option>
                <option value="Vehicles">Vehicles</option>
                <option value="Property">Property</option>
                <option value="Electronics">Electronics</option>
                <option value="Jobs">Jobs</option>
                <option value="Services">Services</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <br>

                <div>
            <label for="location">Location</label>
            <input
                type="text"
                id="location"
                name="location"
                value="{{ old('location') }}"
            >
        </div>

        <br>

        <div>
            <label for="image">Advertisement Image</label>

            <input
                type="file"
                id="image"
                name="image"
                accept="image/jpeg,image/png,image/jpg,image/webp"
            >

            @error('image')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">
            Submit Advertisement
        </button>
    </form>

    <br>

    <a href="{{ route('advertiser.dashboard') }}">
        Back to Dashboard
    </a>

</body>
</html>