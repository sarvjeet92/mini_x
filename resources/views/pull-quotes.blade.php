<h1>Quotes</h1>

@if (isset($error))
    <p>{{ $error }}</p>
@endif

@forelse ($quotes as $quote)
    <div>
        <p>{{ $quote['q'] ?? 'Quote not available' }}</p>
        <strong>— {{ $quote['a'] ?? 'Unknown author' }}</strong>
    </div>
@empty
    <p>No quotes found.</p>
@endforelse