<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Faculty extends Model
{
    /** @use HasFactory<\Database\Factories\FacultyFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'faculty_id';

    protected static function boot(): void
    {
        parent::boot();

        static::created(function ($faculty) {
            $user = User::create([
                'username' => $faculty->faculty_id,
                'password' => bcrypt('faculty')
            ]);

            $user->assignRole('faculty');
        });
    }

    // Relationship to subjects
    public function assignedSubjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'faculty_subject', 'faculty_id', 'subject_id')
            ->withPivot('can_assign_grades');
    }

    // Method to check if faculty can assign grades for a specific subject
    public function canAssignGradesForSubject($subjectId): bool
    {
        return $this->assignedSubjects()
            ->where('subjects.subject_id', $subjectId)
            ->where('faculty_subject.can_assign_grades', true)
            ->exists();
    }
}
