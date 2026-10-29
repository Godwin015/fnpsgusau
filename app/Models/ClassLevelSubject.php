<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassLevelSubject extends Model
{
    protected $table = 'class_level_subject';

    protected $fillable = [
        'class_level_id',
        'subject_id',
    ];

    public function classLevel(): BelongsTo
    {
        return $this->belongsTo(ClassLevel::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}

