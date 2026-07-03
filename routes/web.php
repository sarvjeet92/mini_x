<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageReactionController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\PullQuotesController;

Route::get('/', function () {
    if (session()->has('user_id')) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.submit');

Route::get('/register', [LoginController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [LoginController::class, 'register'])
    ->name('register.submit');

Route::middleware('mini.auth')->group(function () {
    Route::get('/dashboard', [MessageController::class, 'index'])
        ->name('dashboard');

    Route::post('/messages', [MessageController::class, 'store'])
        ->name('messages.store');

    Route::post(
    '/messages/{message}/comments',
    [CommentController::class, 'store']
    )->name('comments.store');

    Route::post(
    '/messages/{message}/reaction',
    [MessageReactionController::class, 'store']
    )->name('messages.reaction');

    Route::post('/contacts', [ContactController::class, 'send'])
        ->name('contacts.send');

    Route::patch(
        '/contacts/{contact}/accept',
        [ContactController::class, 'accept']
    )->name('contacts.accept');

    Route::delete(
    '/contacts/{contact}/reject',
    [ContactController::class, 'reject']
    )->name('contacts.reject');

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    Route::get('/quote/{id}', [QuoteController::class, 'show'])
        ->name('show-quote');
    
    Route::get('/submit-quote', [QuoteController::class, 'create'])
        ->name('quotes.create');

    Route::post('/submit-quote', [QuoteController::class, 'store'])
        ->name('quotes.store');

    Route::get('pull-quotes', [PullQuotesController::class, 'pullQuotes'])
        ->name('pull.quotes');
});