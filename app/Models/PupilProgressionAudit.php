<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PupilProgressionAudit extends Model
{
    protected $fillable = [
        'student_id',
        'source_enrollment_id',
        'destination_enrollment_id',
        'source_session_id',
        'destination_session_id',
        'source_section_id',
        'destination_section_id',
        'action',
        'note',
        'performed_by',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function sourceEnrollment(): BelongsTo
    {
        return $this->belongsTo(
            Enrollment::class,
            'source_enrollment_id'
        );
    }

    public function destinationEnrollment(): BelongsTo
    {
        return $this->belongsTo(
            Enrollment::class,
            'destination_enrollment_id'
        );
    }

    public function performedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
