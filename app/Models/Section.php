<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    protected $fillable = [
        'class_level_id',
        'name',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function classLevel(): BelongsTo
    {
        return $this->belongsTo(ClassLevel::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }


    public function staffAssignments()
    {
        return $this->hasMany(StaffSectionAssignment::class);
    }

    public function assignedStaff()
    {
        return $this->belongsToMany(
            User::class,
            'staff_section_assignments',
            'section_id',
            'user_id'
        )->withTimestamps();
    }

}