<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'total_questions',
        'correct_answers',
        'score',
        'answers',
    ];

    protected $casts = [
        'answers' => 'array',
    ];

    /**
     * Get the user that owns this quiz result.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category for this quiz result.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
