<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentResult extends Model
{
    protected $fillable = [
        'enrollment_id',
        'term',
        'subject_id',
        'first_assessment',
        'second_assessment',
        'exam',
        'entered_by',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'first_assessment' => 'decimal:2',
            'second_assessment' => 'decimal:2',
            'exam' => 'decimal:2',
            'published_at' => 'datetime',
        ];
    }

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function enteredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'entered_by');
    }
}