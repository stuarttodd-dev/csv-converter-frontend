<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAssignedRight extends Model
{
    use HasFactory;

    protected $fillable = [
        'right_id',
        'user_id',
        'is_deleted',
        'version'
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'is_deleted' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function right(): BelongsTo
    {
        return $this->belongsTo(UserRight::class, 'right_id');
    }
}
