<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'subject_id';

    public function academicRecords(): HasMany
    {
        return $this->hasMany(AcademicRecord::class, 'subject_id', 'subject_id');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollments::class, 'subject_id', 'subject_id');
    }

    // Relationship to faculties
    public function assignedFaculties(): BelongsToMany
    {
        return $this->belongsToMany(Faculty::class, 'faculty_subject', 'subject_id', 'faculty_id')
            ->withPivot('can_assign_grades');
    }
}
