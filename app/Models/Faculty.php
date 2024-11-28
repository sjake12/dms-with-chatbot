<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
            User::create([
                'username' => $faculty->faculty_id,
                'password' => bcrypt('faculty')
            ]);
        });
    }
}
