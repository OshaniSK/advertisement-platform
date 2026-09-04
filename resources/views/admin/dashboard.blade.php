<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
</head>

<body>

    <h1>Welcome to Admin Dashboard</h1>

    <p>You are logged in as an administrator.</p>

    <hr>

    <h2>Pending Advertisements</h2>

    @if ($advertisements->count() > 0)

        <table border="1">

            <thead>
                <tr>
                    <th>Title</th>
                    <th>Advertiser</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($advertisements as $advertisement)

                    <tr>

                        <td>{{ $advertisement->title }}</td>

                        <td>{{ $advertisement->user->name }}</td>

                        <td>{{ $advertisement->category }}</td>

                        <td>{{ $advertisement->price }}</td>

                        <td>{{ $advertisement->location }}</td>

                        <td>{{ ucfirst($advertisement->status) }}</td>
<td>

    <form action="{{ route('admin.advertisements.approve', $advertisement) }}" method="POST">
        @csrf
        @method('PATCH')

        <button type="submit">
            Approve
        </button>
    </form>

    <form action="{{ route('admin.advertisements.reject', $advertisement) }}" method="POST">
        @csrf
        @method('PATCH')

        <button type="submit">
            Reject
        </button>
    </form>

</td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <p>There are no pending advertisements.</p>

    @endif

</body>

</html>