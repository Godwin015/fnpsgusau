<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'admission_number',
        'first_name',
        'last_name',
        'middle_name',
        'date_of_birth',
        'gender',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }
}