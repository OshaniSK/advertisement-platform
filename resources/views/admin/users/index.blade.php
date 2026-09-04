<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
</head>
<body>

    <h1>Manage Users</h1>

    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Log Out</button>
    </form>

    @if (session('success'))
    <p>{{ session('success') }}</p>
    @endif

    <p>
        <a href="{{ route('admin.dashboard') }}">
            Back to Admin Dashboard
        </a>
    </p>

    <hr>

    @if ($users->count() > 0)

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>

        <td>
            <form method="POST"
                  action="{{ route('admin.users.updateRole', $user) }}">

                @csrf
                @method('PATCH')

                <select name="role">
                    <option value="visitor"
                        {{ $user->role === 'visitor' ? 'selected' : '' }}>
                        Visitor
                    </option>

                    <option value="advertiser"
                        {{ $user->role === 'advertiser' ? 'selected' : '' }}>
                        Advertiser
                    </option>

                    <option value="admin"
                        {{ $user->role === 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                </select>

                <button type="submit">
                    Update Role
                </button>
            </form>
        </td>
    </tr>
@endforeach
            </tbody>
        </table>

    @else

        <p>No users found.</p>

    @endif

</body>
</html>