<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRightGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_name',
        'icon_class',
        'href',
        'ordering',
        'is_deleted',
        'version'
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'is_deleted' => 'boolean',
    ];
}
