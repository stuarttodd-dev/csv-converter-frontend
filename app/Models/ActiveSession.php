<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'updated_at',
        'created_at',
        'is_deleted',
        'version'
    ];

    protected $casts = [
        'is_deleted' => 'boolean',
    ];

}
