<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResultPublicationAudit extends Model
{
    protected $fillable = [
        'academic_session_id',
        'section_id',
        'term',
        'action',
        'performed_by',
        'eligible_count',
        'excluded_count',
        'details',
    ];

    protected function casts(): array
    {
        return [
            'eligible_count' => 'integer',
            'excluded_count' => 'integer',
            'details' => 'array',
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

    public function performedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
