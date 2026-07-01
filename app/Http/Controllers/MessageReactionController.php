<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Message;
use App\Models\MessageReaction;
use Illuminate\Http\Request;

class MessageReactionController extends Controller
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

        $data = $request->validate([
            'reaction' => [
                'required',
                'string',
                'in:like,dislike',
            ],
        ]);

        $userId = (int) $request->session()->get('user_id');

        /*
         * User can react when:
         * 1. It is their own post, or
         * 2. The post owner is their accepted friend.
         */
        $canReact = $message->user_id == $userId;

        if (!$canReact) {
            $canReact = Contact::where('accepted', true)
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

        if (!$canReact) {
            return back()->withErrors([
                'reaction' => 'You cannot react to this post.',
            ]);
        }

        $existingReaction = MessageReaction::where(
            'message_id',
            $message->id
        )
            ->where('user_id', $userId)
            ->first();

        /*
         * Same button clicked again:
         * remove the reaction.
         */
        if (
            $existingReaction &&
            $existingReaction->reaction === $data['reaction']
        ) {
            $existingReaction->delete();

            return back()->with(
                'success',
                ucfirst($data['reaction']) . ' removed.'
            );
        }

        /*
         * User already reacted differently:
         * change like to dislike or dislike to like.
         */
        if ($existingReaction) {
            $existingReaction->update([
                'reaction' => $data['reaction'],
                'time' => time(),
            ]);

            return back()->with(
                'success',
                'Reaction updated.'
            );
        }

        /*
         * User has no existing reaction:
         * create a new one.
         */
        MessageReaction::create([
            'message_id' => $message->id,
            'user_id' => $userId,
            'reaction' => $data['reaction'],
            'time' => time(),
        ]);

        return back()->with(
            'success',
            ucfirst($data['reaction']) . ' added.'
        );
    }
}