<!DOCTYPE html>
<html>

<head>
    <title>Edit Advertisement</title>
</head>

<body>

    <h1>Edit Advertisement</h1>


    {{-- Validation Errors --}}
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


    {{-- Success Message --}}
    @if (session('success'))
        <div style="padding: 10px; margin-bottom: 20px; background-color: #d4edda; color: #155724;">
            {{ session('success') }}
        </div>
    @endif


    {{-- Edit Advertisement Form --}}
    <form
        action="{{ route('advertisements.update', $advertisement) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        {{-- Title --}}
        <div>
            <label for="title">
                Advertisement Title
            </label>

            <br>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title', $advertisement->title) }}"
                required
            >
        </div>


        <br>


        {{-- Description --}}
        <div>
            <label for="description">
                Description
            </label>

            <br>

            <textarea
                id="description"
                name="description"
                rows="5"
                required
            >{{ old('description', $advertisement->description) }}</textarea>
        </div>


        <br>


        {{-- Price --}}
        <div>
            <label for="price">
                Price
            </label>

            <br>

            <input
                type="number"
                id="price"
                name="price"
                step="0.01"
                min="0"
                value="{{ old('price', $advertisement->price) }}"
            >
        </div>


        <br>


        {{-- Category --}}
        <div>
            <label for="category">
                Category
            </label>

            <br>

            <select id="category" name="category">

                <option value="">
                    Select Category
                </option>

                <option
                    value="Vehicles"
                    {{ old('category', $advertisement->category) == 'Vehicles' ? 'selected' : '' }}
                >
                    Vehicles
                </option>

                <option
                    value="Property"
                    {{ old('category', $advertisement->category) == 'Property' ? 'selected' : '' }}
                >
                    Property
                </option>

                <option
                    value="Electronics"
                    {{ old('category', $advertisement->category) == 'Electronics' ? 'selected' : '' }}
                >
                    Electronics
                </option>

                <option
                    value="Jobs"
                    {{ old('category', $advertisement->category) == 'Jobs' ? 'selected' : '' }}
                >
                    Jobs
                </option>

                <option
                    value="Services"
                    {{ old('category', $advertisement->category) == 'Services' ? 'selected' : '' }}
                >
                    Services
                </option>

                <option
                    value="Other"
                    {{ old('category', $advertisement->category) == 'Other' ? 'selected' : '' }}
                >
                    Other
                </option>

            </select>
        </div>


        <br>


        {{-- Location --}}
        <div>
            <label for="location">
                Location
            </label>

            <br>

            <input
                type="text"
                id="location"
                name="location"
                value="{{ old('location', $advertisement->location) }}"
            >
        </div>


        <br>


        {{-- Current Image --}}
        <div>

            <label>
                Current Advertisement Image
            </label>

            <br><br>

            @if ($advertisement->image)

                <img
                    src="{{ asset('storage/' . $advertisement->image) }}"
                    alt="{{ $advertisement->title }}"
                    width="300"
                >

            @else

                <p>
                    No image uploaded.
                </p>

            @endif

        </div>


        <br>


        {{-- New Image --}}
        <div>

            <label for="image">
                Replace Advertisement Image
            </label>

            <br>

            <input
                type="file"
                id="image"
                name="image"
                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
            >

            <br>

            <small>
                Leave this empty if you want to keep the current image.
            </small>

            <br>

            <small>
                Maximum size: 2MB.
            </small>

        </div>


        <br>


        {{-- Submit --}}
        <button type="submit">
            Update Advertisement
        </button>

    </form>


    <br>


    {{-- Back to Dashboard --}}
    <a href="{{ route('advertiser.dashboard') }}">
        Back to Dashboard
    </a>

</body>

</html>