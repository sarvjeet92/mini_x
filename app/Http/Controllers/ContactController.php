<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'friend_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $userId = $request->session()->get('user_id');
        $friendId = (int) $data['friend_id'];

        if ($userId === $friendId) {
            return back()->withErrors([
                'friend' => 'You cannot send a friend request to yourself.',
            ]);
        }

        $alreadyExists = Contact::where(function ($query) use ($userId, $friendId) {
            $query->where(function ($insideQuery) use ($userId, $friendId) {
                $insideQuery->where('user_id', $userId)
                    ->where('friend_id', $friendId);
            })->orWhere(function ($insideQuery) use ($userId, $friendId) {
                $insideQuery->where('user_id', $friendId)
                    ->where('friend_id', $userId);
            });
        })->exists();

        if ($alreadyExists) {
            return back()->withErrors([
                'friend' => 'A friend request or friendship already exists.',
            ]);
        }

        Contact::create([
            'user_id' => $userId,
            'friend_id' => $friendId,
            'accepted' => false,
        ]);

        return back()->with(
            'success',
            'Friend request sent successfully.'
        );
    }

    public function accept(Request $request, Contact $contact)
    {
        $userId = $request->session()->get('user_id');

        if (
            $contact->friend_id != $userId ||
            $contact->accepted
        ) {
            abort(403);
        }

        $contact->update([
            'accepted' => true,
        ]);

        return back()->with(
            'success',
            'Friend request accepted.'
        );
    }

    public function reject(Request $request, Contact $contact)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'login' => 'Please login first.',
                ]);
        }

        $userId = $request->session()->get('user_id');

        // Only the person receiving the request can reject it
        if ($contact->friend_id != $userId) {
            return back()->withErrors([
                'friend' => 'You cannot reject this request.',
            ]);
        }

        // Accepted friendships cannot be rejected using this button
        if ($contact->accepted) {
            return back()->withErrors([
                'friend' => 'This request has already been accepted.',
            ]);
        }

        $contact->delete();

        return back()->with(
            'success',
            'Friend request rejected.'
        );
    }
}