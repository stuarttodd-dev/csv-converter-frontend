<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'system_id',
        'user_id',
        'activity',
        'is_deleted',
        'version',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'is_deleted' => 'boolean',
    ];

    public function system()
    {
        return $this->hasOne(AccessibleSystem::class, 'id', 'system_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
