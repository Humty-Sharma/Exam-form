<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamForm extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'fees', 'is_active', 'published_at'
    ];

    protected $casts = [
        // 'meta' => 'array',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function fields()
    {
        return $this->hasMany(FormField::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
