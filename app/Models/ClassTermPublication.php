<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassTermPublication extends Model
{
    protected $fillable = [
        'academic_session_id',
        'section_id',
        'term',
        'is_published',
        'published_by',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function publishedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'published_by');
    }
}
