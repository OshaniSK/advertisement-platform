<!DOCTYPE html>
<html>
<head>
    <title>Create Advertisement</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6f8;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        h1 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
        }

        .image-help {
            color: #666;
            font-size: 13px;
            margin-top: 5px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover {
            background: #1d4ed8;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #374151;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Create Advertisement</h1>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="error">

            <strong>Please fix the following errors:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif

    {{-- Success Message --}}
    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif


    <form
        action="{{ route('advertisements.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- TITLE --}}
        <div class="form-group">

            <label for="title">
                Advertisement Title
            </label>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                required
            >

        </div>


        {{-- DESCRIPTION --}}
        <div class="form-group">

            <label for="description">
                Description
            </label>

            <textarea
                id="description"
                name="description"
                rows="6"
                required
            >{{ old('description') }}</textarea>

        </div>


        {{-- PRICE --}}
        <div class="form-group">

            <label for="price">
                Price
            </label>

            <input
                type="number"
                id="price"
                name="price"
                step="0.01"
                min="0"
                value="{{ old('price') }}"
            >

        </div>


        {{-- CATEGORY --}}
        <div class="form-group">

            <label for="category">
                Category
            </label>

            <select
                id="category"
                name="category"
            >

                <option value="">
                    Select Category
                </option>

                <option value="Vehicles"
                    {{ old('category') == 'Vehicles' ? 'selected' : '' }}>
                    Vehicles
                </option>

                <option value="Property"
                    {{ old('category') == 'Property' ? 'selected' : '' }}>
                    Property
                </option>

                <option value="Electronics"
                    {{ old('category') == 'Electronics' ? 'selected' : '' }}>
                    Electronics
                </option>

                <option value="Jobs"
                    {{ old('category') == 'Jobs' ? 'selected' : '' }}>
                    Jobs
                </option>

                <option value="Services"
                    {{ old('category') == 'Services' ? 'selected' : '' }}>
                    Services
                </option>

                <option value="Other"
                    {{ old('category') == 'Other' ? 'selected' : '' }}>
                    Other
                </option>

            </select>

        </div>


        {{-- LOCATION --}}
        <div class="form-group">

            <label for="location">
                Location
            </label>

            <input
                type="text"
                id="location"
                name="location"
                value="{{ old('location') }}"
            >

        </div>


        {{-- MAIN IMAGE --}}
        <div class="form-group">

            <label for="image">
                Main Advertisement Image
            </label>

            <input
                type="file"
                id="image"
                name="image"
                accept="image/jpeg,image/png,image/jpg,image/webp"
            >

            <div class="image-help">
                This image will be used as the main advertisement image.
            </div>

            @error('image')
                <p style="color:red;">
                    {{ $message }}
                </p>
            @enderror

        </div>


        {{-- MULTIPLE IMAGES --}}
        <div class="form-group">

            <label for="images">
                Additional Images
            </label>

            <input
                type="file"
                id="images"
                name="images[]"
                accept="image/jpeg,image/png,image/jpg,image/webp"
                multiple
            >

            <div class="image-help">
                You can select up to 10 additional images.
            </div>

            @error('images')
                <p style="color:red;">
                    {{ $message }}
                </p>
            @enderror

            @error('images.*')
                <p style="color:red;">
                    {{ $message }}
                </p>
            @enderror

        </div>


        {{-- SUBMIT --}}
        <button type="submit">
            Submit Advertisement
        </button>

    </form>


    <a
        href="{{ route('advertiser.dashboard') }}"
        class="back-link"
    >
        ← Back to Dashboard
    </a>

</div>

</body>
</html>