<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->session()->get('user_id');

        $currentUser = User::findOrFail($userId);

        $pendingRequests = Contact::with('sender')
            ->where('friend_id', $userId)
            ->where('accepted', false)
            ->get();

        $sentRequests = Contact::with('receiver')
            ->where('user_id', $userId)
            ->where('accepted', false)
            ->get();

        $relatedContacts = Contact::where(function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->orWhere('friend_id', $userId);
        })->get();

        $existingUserIds = collect(
        $relatedContacts
            ->map(function ($contact) use ($userId) {
                if ($contact->user_id == $userId) {
                    return $contact->friend_id;
                }

                return $contact->user_id;
            })
            ->all()
    )
        ->unique()
        ->values();

        $acceptedFriendIds = collect(
            $relatedContacts
                ->where('accepted', true)
                ->map(function ($contact) use ($userId) {
                    if ($contact->user_id == $userId) {
                        return $contact->friend_id;
                    }

                    return $contact->user_id;
                })
                ->all()
    )
        ->unique()
        ->values();

        // User can see their own posts and accepted friends' posts
        $allowedUserIds = $acceptedFriendIds
            ->concat([(int) $userId])
            ->unique()
            ->values();

        $messages = Message::with([
        'user',
        'comments.user',

                // Load only the logged-in user's reaction
                'reactions' => function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                },
            ])
            ->withCount([
                'reactions as likes_count' => function ($query) {
                    $query->where('reaction', 'like');
                },

                'reactions as dislikes_count' => function ($query) {
                    $query->where('reaction', 'dislike');
                },
            ])
            ->whereIn('user_id', $allowedUserIds)
            ->orderByDesc('time')
            ->get();

        $friends = User::whereIn('id', $acceptedFriendIds->all())
            ->orderBy('name')
            ->get();



        $phoneSearch = trim((string) $request->query('phone'));

        $availableUsersQuery = User::where('id', '!=', $userId)
            ->whereNotIn('id', $existingUserIds);

        if ($phoneSearch !== '') {
            $availableUsersQuery->where(
                'phone',
                'like',
                '%' . $phoneSearch . '%'
            );
        }

        $availableUsers = $availableUsersQuery
            ->orderBy('name')
            ->get();

        return view('dashboard', compact(
            'currentUser',
            'messages',
            'pendingRequests',
            'sentRequests',
            'friends',
            'availableUsers',
            'phoneSearch'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        Message::create([
            'message' => $data['message'],
            'user_id' => $request->session()->get('user_id'),
            'time' => time(),
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Message posted successfully.');
    }
}