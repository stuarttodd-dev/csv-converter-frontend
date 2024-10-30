<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'contribution_type',
        'points',
        'note',
        'is_deleted',
        'created_at',
        'updated_at',
        'version',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'contribution_type' => 'string',
        'points' => 'integer',
        'is_deleted' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'version' => 'integer',
    ];

}
