<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        'time_limit',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
