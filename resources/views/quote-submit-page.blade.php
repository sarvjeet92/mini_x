<body>
    <main class="card">
        <form method="POST" action="{{ route('quote.submit') }}">
            @csrf

            <label for="quote">Quote</label>
            <input
                type="text"
                id="quote"
                name="quote"
                value="{{ old('quote') }}"
                required
                autofocus
            >
            <button type="submit">
                Submit Quote
            </button>
        </form>
    </main>
</body>