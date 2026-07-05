<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'host_id',
        'category_id',
        'status',
    ];

    /**
     * Get the host user of the room.
     */
    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    /**
     * Get the quiz category for the room.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the users in the room lobby.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'room_users', 'room_id', 'user_id')->withTimestamps();
    }

    /**
     * Get all quiz results submitted in this room.
     */
    public function results()
    {
        return $this->hasMany(QuizResult::class, 'room_id');
    }
}
