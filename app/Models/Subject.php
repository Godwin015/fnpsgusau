<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'code',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function classLevels(): BelongsToMany
    {
        return $this->belongsToMany(
            ClassLevel::class,
            'class_level_subject'
        )->withTimestamps();
    }

    public function studentResults(): HasMany
    {
        return $this->hasMany(StudentResult::class);
    }
}

