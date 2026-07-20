<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function edit(User $user)
        {
            return view ('users.edit', compact('user'));
        }

    public function update(Request $request, User $user)

        {
            $data = $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email'],
            ]);

            //dd($user, $data);

            $user->update($data);

            return redirect()
                ->route('users.index')
                ->with('success', 'User updated successfully.');
        }
    public function index()

        {
            $users = User::all();

            return view('users.index', compact('users'));
        }
}
