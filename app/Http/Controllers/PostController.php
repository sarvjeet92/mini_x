<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function store()
    {
        $api_URL = 'https://api.attackontitanapi.com/characters';

        $response = Http::get($api_URL);
        $data = $response->json();  
        // dd($data);
        return view('posts.index', compact('data'));
       
    }
}
