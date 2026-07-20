<h1>Edit User</h1>

<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <label>Name</label>

    <input
        type="text"
        name="name"
        value="{{ old('name', $user->name) }}"
    >

    <label>Email</label>

    <input
        type="email"
        name="email"
        value="{{ old('email', $user->email) }}"
    >

    <button type="submit">Update User</button>
</form>