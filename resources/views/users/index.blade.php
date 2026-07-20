<h1>Users</h1>

@if (session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif

@foreach ($users as $user)
    <div>
        <p>
            <strong>Name:</strong> {{ $user->name }}
        </p>

        <p>
            <strong>Email:</strong> {{ $user->email }}
        </p>

        <a href="{{ route('users.edit', $user->id) }}">
            Edit
        </a>
    </div>

    <hr>
@endforeach