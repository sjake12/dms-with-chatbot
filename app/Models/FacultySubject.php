<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FacultySubject extends Model
{
    /** @use HasFactory<\Database\Factories\FacultySubjectFactory> */
    use HasFactory;

    protected $table = 'faculty_subject';
    protected $primaryKey = 'id';

    protected $fillable = [
        'faculty_id',
        'subject_id',
        'can_assign_grades'
    ];

    // Relationships
    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'faculty_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_id');
    }
}
