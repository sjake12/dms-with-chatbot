<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admin extends Model
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'admin_id';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    protected static function boot(): void
    {
        parent::boot();

        static::created(function ($admin) {
            $user = User::create([
                'username' => $admin->admin_id,
                'password' => bcrypt('admin'),
            ]);

            $user->assignRole('admin');
        });
    }
}
