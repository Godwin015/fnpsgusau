<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StaffSectionAssignment extends Model
{
    protected $fillable = [
        'user_id',
        'section_id',
        'assigned_by',
    ];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}

