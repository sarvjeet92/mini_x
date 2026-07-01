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
}
