<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Contact;
use App\Models\Message;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Message $message)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'login' => 'Please login first.',
                ]);
        }

        $userId = (int) $request->session()->get('user_id');

        $data = $request->validate([
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        /*
         * The user can comment when:
         * 1. It is their own post, or
         * 2. The post owner is their accepted friend.
         */
        $canComment = $message->user_id == $userId;

        if (!$canComment) {
            $canComment = Contact::where('accepted', true)
                ->where(function ($query) use ($userId, $message) {
                    $query
                        ->where(function ($insideQuery) use (
                            $userId,
                            $message
                        ) {
                            $insideQuery
                                ->where('user_id', $userId)
                                ->where(
                                    'friend_id',
                                    $message->user_id
                                );
                        })
                        ->orWhere(function ($insideQuery) use (
                            $userId,
                            $message
                        ) {
                            $insideQuery
                                ->where(
                                    'user_id',
                                    $message->user_id
                                )
                                ->where('friend_id', $userId);
                        });
                })
                ->exists();
        }

        if (!$canComment) {
            return back()->withErrors([
                'comment' => 'You cannot comment on this post.',
            ]);
        }

        Comment::create([
            'message_id' => $message->id,
            'user_id' => $userId,
            'comment' => $data['comment'],
            'time' => time(),
        ]);

        return back()->with(
            'success',
            'Comment added successfully.'
        );
    }
}