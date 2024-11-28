<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    /** @use HasFactory<\Database\Factories\ProgramFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'program_id';

    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'course');
    }
}
