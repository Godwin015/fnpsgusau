<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id',
        'academic_session_id',
        'section_id',
        'promotion_status',
        'enrollment_status',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }


    public function studentResults()
    {
        return $this->hasMany(StudentResult::class);
    }

    public function feeStatuses(): HasMany
    {
        return $this->hasMany(StudentFeeStatus::class);
    }

    public function feeStatusAudits(): HasMany
    {
        return $this->hasMany(FeeStatusAudit::class);
    }

}