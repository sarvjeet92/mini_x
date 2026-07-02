<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Quote</title>
</head>
<body>

    <h1>Submit a Quote</h1>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('quotes.store') }}" method="POST">
        @csrf

        <label for="quote">Quote</label>

        <input
            type="text"
            id="quote"
            name="quote"
            value="{{ old('quote') }}"
            required
        >

        <button type="submit">
            Submit Quote
        </button>
    </form>

</body>
</html>