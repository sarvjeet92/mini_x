<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class PullQuotesController extends Controller
{
    public function pullQuotes()
    {
        try {
            $response = Http::connectTimeout(10)
                ->timeout(20)
                ->get('https://zenquotes.io/api/quotes');

            if ($response->failed()) {
                return view('pull-quotes', [
                    'quotes' => [],
                    'error' => 'Unable to get quotes from the API.',
                ]);
            }

            // Convert the JSON response into a PHP array
            $quotes = $response->json();

            return view('pull-quotes', compact('quotes'));

        } catch (ConnectionException $exception) {
            return view('pull-quotes', [
                'quotes' => [],
                'error' => 'Could not connect to ZenQuotes.',
            ]);
        }
    }
}