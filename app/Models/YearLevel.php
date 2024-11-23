<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class YearLevel extends Model
{
    /** @use HasFactory<\Database\Factories\YearLevelFactory> */
    use HasFactory;

    protected $guarded = [];

    public function user(): HasMany
    {
        $this->hasMany(User::class, 'year_level');
    }
}
