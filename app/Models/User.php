<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'login_id',
        'student_id',
        'must_change_pin',
        'must_change_password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'must_change_pin' => 'boolean',
            'must_change_password' => 'boolean',
        ];
    }
    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class);
    }


    public function sectionAssignments()
    {
        return $this->hasMany(StaffSectionAssignment::class, 'user_id');
    }

    public function assignedSections()
    {
        return $this->belongsToMany(
            Section::class,
            'staff_section_assignments',
            'user_id',
            'section_id'
        )->withTimestamps();
    }

}

