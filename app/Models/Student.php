<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'student_id';

    public function academicRecords(): HasMany
    {
        return $this->hasMany(AcademicRecord::class, 'student_id', 'student_id');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollments::class, 'student_id', 'student_id');
    }

    public function program(): HasOne
    {
        return $this->hasOne(Program::class, 'program_id', 'program_id');
    }

    public function year_level(): HasOne
    {
        return $this->hasOne(YearLevel::class, 'year_level_id', 'year_level_id');
    }

    protected static function boot():void
    {
        parent::boot();

        static::created(function ($student) {
           $user =  User::create([
                'username' => $student->student_id,
                'password' => bcrypt('1234')
            ]);

           $user->assignRole('student');
        });
    }
}
