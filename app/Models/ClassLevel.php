<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassLevel extends Model
{
    protected $fillable = [
        'name',
        'code',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }


    public function subjects()
    {
        return $this->belongsToMany(
            Subject::class,
            'class_level_subject'
        )->withTimestamps();
    }

}