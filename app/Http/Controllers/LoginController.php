<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin(Request $request)
    {
        if ($request->session()->has('user_id')) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'pwd' => ['required'],
        ]);

        $user = User::where('email', $data['email'])
            ->where('pwd', $data['pwd'])
            ->first();

        if (!$user) {
            return back()
                ->withErrors([
                    'email' => 'Email or password is incorrect.',
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();
        $request->session()->put('user_id', $user->id);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Login successful.');
    }

    public function showRegister(Request $request)
    {
        if ($request->session()->has('user_id')) {
            return redirect()->route('dashboard');
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'pwd' => ['required', 'string', 'min:3', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        $currentTime = time();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'pwd' => $data['pwd'],
            'phone' => $data['phone'],
            'created' => $currentTime,
            'updated' => $currentTime,
        ]);

        $request->session()->regenerate();
        $request->session()->put('user_id', $user->id);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Account created successfully.');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'You have been logged out.');
    }
}