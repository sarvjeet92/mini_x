<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'pwd',
        'phone',
        'created',
        'updated',
    ];

    protected $hidden = [
        'pwd',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function sentContacts()
    {
        return $this->hasMany(Contact::class, 'user_id');
    }

    public function receivedContacts()
    {
        return $this->hasMany(Contact::class, 'friend_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function messageReactions()
    {
        return $this->hasMany(MessageReaction::class);
    }
}