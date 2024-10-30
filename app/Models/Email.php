<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email_body',
        'is_deleted',
        'created_at',
        'updated_at',
        'version',
    ];

    protected $casts = [
        'project_id' => 'integer',
        'user_id' => 'integer',
        'is_deleted' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'version' => 'integer',
    ];

}
