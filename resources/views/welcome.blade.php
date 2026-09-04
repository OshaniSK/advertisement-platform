<!DOCTYPE html>
<html>
<head>
    <title>Advertisement Platform</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #1f2937;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
        }

        .title {
            text-align: center;
            margin-bottom: 30px;
        }

        .advertisements {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .advertisement {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .advertisement h2 {
            margin-top: 0;
        }

        .price {
            font-size: 20px;
            font-weight: bold;
        }

        .location {
            color: #666;
        }

        .button {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<header>
    <h1>Advertisement Platform</h1>

    <nav>
        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>

            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit"
                    style="background:none;border:none;color:white;cursor:pointer;margin-left:20px;">
                    Log Out
                </button>
            </form>
        @else
            <a href="{{ route('login') }}">Log In</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </nav>
</header>

<div class="container">

    <div class="title">
        <h1>Approved Advertisements</h1>
        <p>Browse advertisements from our sellers.</p>
    </div>

    <div class="advertisements">

        @forelse ($advertisements as $advertisement)

            <div class="advertisement">

                <h2>{{ $advertisement->title }}</h2>

                <p>{{ $advertisement->description }}</p>

                <p class="price">
                    Rs. {{ number_format($advertisement->price, 2) }}
                </p>

                <p>
                    <strong>Category:</strong>
                    {{ $advertisement->category }}
                </p>

                <p class="location">
                    <strong>Location:</strong>
                    {{ $advertisement->location }}
                </p>

                <a href="{{ route('advertisements.show', $advertisement) }}"
                   class="button">
                    View Advertisement
                </a>

            </div>

        @empty

            <p>No approved advertisements available.</p>

        @endforelse

    </div>

</div>

</body>
</html>