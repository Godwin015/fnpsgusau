<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentFeeStatus extends Model
{
    public const PAID = 'paid';
    public const NOT_PAID = 'not_paid';

    public const TERMS = [
        'First Term',
        'Second Term',
        'Third Term',
    ];

    protected $fillable = [
        'enrollment_id',
        'term',
        'status',
        'updated_by',
    ];

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
