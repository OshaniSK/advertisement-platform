<!DOCTYPE html>
<html>
<head>
    <title>Contact Seller</title>
</head>

<body>

    <h1>Contact Seller</h1>

    <h2>{{ $advertisement->title }}</h2>

    <p>
        <strong>Seller:</strong>
        {{ $advertisement->user->name }}
    </p>

    <p>
        You can contact the seller regarding this advertisement.
    </p>

    <form method="POST" action="{{ route('contact.seller.send', $advertisement) }}">
    @csrf
        <div>
            <label>Your Message:</label><br>

            <textarea
                name="message"
                rows="6"
                cols="50"
                placeholder="Type your message to the seller..."
            ></textarea>
        </div>

        <br>

        <button type="submit">
            Send Message
        </button>
    </form>

    <br>

    <a href="{{ route('advertisements.show', $advertisement) }}">
        Back to Advertisement
    </a>

</body>
</html>