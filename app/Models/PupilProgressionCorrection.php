<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PupilProgressionCorrection extends Model
{
    protected $fillable = [
        'pupil_progression_audit_id',
        'student_id',
        'performed_by',
        'correction_type',
        'reason',
        'before_snapshot',
        'after_snapshot',
    ];

    protected function casts(): array
    {
        return [
            'before_snapshot' => 'array',
            'after_snapshot' => 'array',
        ];
    }

    public function progressionAudit(): BelongsTo
    {
        return $this->belongsTo(
            PupilProgressionAudit::class,
            'pupil_progression_audit_id'
        );
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function performedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'performed_by'
        );
    }
}