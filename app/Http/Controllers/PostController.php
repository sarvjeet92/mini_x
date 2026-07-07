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
        
        {
           // echo "<pre>";
            dd($response->json());




        }



        echo "<pre>";
        print_r($data);
        die();
    }
}
