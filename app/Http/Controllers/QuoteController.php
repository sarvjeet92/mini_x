<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;

class QuoteController extends Controller
{
    public function show($id)
    {
        $quote = Quote::find($id);

        return view('show-quote', compact('quote'));
    }

    public function create()
    {
        return view('quote-submit-page');
    }

    public function store(Request $request)
    {
        $request->validate([
            'quote' => 'required|string|max:255',
        ]);

        Quote::create([
            'quote_text' => $request->quote,
        ]);

        return redirect()
            ->route('quotes.create')
            ->with('success', 'Quote submitted successfully.');
    }
}
