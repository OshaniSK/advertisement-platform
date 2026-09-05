<!DOCTYPE html>
<html>
<head>
    <title>Visitor Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f5f5f5;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .badge {
            background-color: red;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
        }

        .advertisement {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .advertisement h3 {
            margin-top: 0;
        }

        .button {
            display: inline-block;
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="header">

        <h1>Visitor Dashboard</h1>
        <p>
    <a href="{{ route('messages.inbox') }}">
        💬 My Messages
    </a>

    @if ($unreadMessages > 0)
        <span style="
            background: red;
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
        ">
            {{ $unreadMessages }} unread
        </span>
    @endif
</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Log Out</button>
        </form>

    </div>

    <hr>

    {{-- Unread Messages --}}

    <h2>
        Messages

        @if ($unreadMessages > 0)

            <span class="badge">
                {{ $unreadMessages }} Unread
            </span>

        @else

            <span>
                (No unread messages)
            </span>

        @endif
    </h2>

    <p>
        <a href="{{ route('messages.inbox') }}" class="button">
            View My Messages
        </a>
    </p>

    <hr>

    <h2>Latest Advertisements</h2>

    @forelse ($advertisements as $advertisement)

        <div class="advertisement">

            <h3>
                {{ $advertisement->title }}
            </h3>

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

            <a
                href="{{ route('advertisements.show', $advertisement) }}"
                class="button"
            >
                View Details
            </a>

        </div>

    @empty

        <p>
            No advertisements available.
        </p>

    @endforelse

    <hr>

    <p>
        <a href="{{ route('advertisements.index') }}">
            View All Advertisements
        </a>
    </p>

</body>
</html>